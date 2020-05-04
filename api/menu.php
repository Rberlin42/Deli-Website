<?php
    include_once('db-connect.php');
    $method = $_SERVER['REQUEST_METHOD'];
    
    // open db connection
    $db = openDatabaseConnection();
    if(is_null($db)) {
        http_response_code(503);
        return;
    }
    
    // find the method
    if($method == 'GET') {
        getMenu($db);
    }
    elseif($method == 'POST') {
        updateMenu($db);
    }
    else {
        http_response_code(405);
    }
    $db = null;

    /**
     * Output a menu
     * output formmatted as per api-def.txt
     */
    function getMenu($db){
        if(!isset($_GET['type'])) {
            http_response_code(400);
            return;
        }
        $type = $_GET['type'];
        
        // get the sections first
        $stmt = $db->prepare('SELECT * FROM menu_sections WHERE type = ?');
        try {
            $stmt->execute([$type]);
        }
        catch (Exception $e) {
            http_response_code(500);
            die($e->getMessage());
        }
        $sections = $stmt->fetchAll();

        // build menu
        $menu = array();
        foreach($sections as $s) {
            $items = getMenuItems($db, $s['id']);
            $menu[] = array('sectionId'=>$s['id'], 'sectionName'=>$s['name'], 'sectionPosition'=>$s['position'], 'items'=>$items);
        }

        echo json_encode($menu);
    }

    /**
     * Return a list of menu items for the given section
     * formatted as per api-def.txt
     */
    function getMenuItems($db, $sectionID) {
        $stmt = $db->prepare('SELECT * FROM menu_items WHERE sectionID = ?');
        try {
            $stmt->execute([$sectionID]);
        }
        catch (Exception $e) {
            http_response_code(500);
            die($e->getMessage());
        }

        
        $items = $stmt->fetchAll();

        // format properly
        $formatItems = array();
        foreach($items as $i) {
            $formatItems[] = array('id'=>$i['id'], 'name'=>$i['name'], 'description'=>$i['description'], 'price'=>$i['price'], 'position'=>$i['position']);
        }

        return $formatItems;
    }

    /**
     * update menu
     * return new section and item ids
     */
    function updateMenu($db) {
        $input = json_decode(file_get_contents('php://input'), true);

        deleteSections($input['deleteSection'], $db);
        $sectionIds = addSections($input['addSection'], $db);
        updateSections($input['updateSection'], $db);
        deleteItems($input['deleteItem'], $db);
        $itemIds = addItems($input['addItem'], $db);
        updateItems($input['updateItem'], $db);

        echo json_encode(array('newSections'=>$sectionIds, 'newItems'=>$itemIds));
    }

    /**
     * Delete sections and all thier items for given section ids
     */
    function deleteSections($ids, $db) {
        if(count($ids) == 0)
            return;

        // build the query
        $idList = '(';
        foreach($ids as $id) {
            $idList .= $id . ',';
        }
        $idList = rtrim($idList, ',') . ')';
        $query = 'DELETE FROM menu_items WHERE sectionID IN ' . $idList . ';';
        $query .= 'DELETE FROM menu_sections WHERE id IN ' . $idList . ';';

        $stmt = $db->prepare($query);
        try {
            $stmt->execute();
        }
        catch (Exception $e){
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    /**
     * add new sections
     * Return new ids
     */
    function addSections($sections, $db) {
        // get menu type
        if(!isset($_REQUEST['type'])) {
            http_response_code(400);
            return;
        }
        $type = $_REQUEST['type'];

        if(count($sections) == 0)
            return [];

        // build the query
        $query = 'INSERT INTO menu_sections (name, type, position) VALUES ';
        foreach($sections as $s) {
            $query .= '("' . $s['name'] . '","' . $type . '",' . $s['position'] . '),';
        }
        $query = rtrim($query, ',') . ';';

        $stmt = $db->prepare($query);
        try {
            $stmt->execute();
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
            return;
        }

        // get and return the new ids
        $id = $db->lastInsertId();
        return range($id, $id + count($sections) - 1);
    }

    /**
     * Update given announcements
     */
    function updateSections($sections, $db) {
        if(count($sections) == 0)
            return;
    
        // build the query
        $queryString = 'UPDATE menu_sections SET name="%s", position=%d WHERE id=%d;';
        $query = '';
        foreach($sections as $s) {
            $query .= sprintf($queryString, $s['name'], $s['position'], $s['id']);
        }

        $stmt = $db->prepare($query);
        try {
            $stmt->execute();
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    /**
     * Delete menu items with the given ids
     */
    function deleteItems($ids, $db) {
        if(count($ids) == 0)
        return;

        // build the query
        $idList = '(';
        foreach($ids as $id) {
            $idList .= $id . ',';
        }
        $idList = rtrim($idList, ',') . ')';
        $query = 'DELETE FROM menu_items WHERE id IN ' . $idList . ';';

        $stmt = $db->prepare($query);
        try {
            $stmt->execute();
        }
        catch (Exception $e){
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    /**
     * Add new menu items
     * Return new ids
     */
    function addItems($items, $db) {
        if(count($items) == 0)
            return [];

        // build the query
        $query = 'INSERT INTO menu_items (name, description, sectionID, price, position) VALUES ';
        foreach($items as $i) {
            $query .= '("' . $i['name'] . '","' . $i['description'] . '",' . $i['sectionId'] . ',"' . $i['price'] . '",' . $i['position'] . '),';
        }
        $query = rtrim($query, ',') . ';';

        
        $stmt = $db->prepare($query);
        try {
            $stmt->execute();
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
            return;
        }

        // get and return the new ids
        $id = $db->lastInsertId();
        return range($id, $id + count($items) - 1);
    }

    /**
     * Update menu items
     */
    function updateItems($items, $db) {
        if(count($items) == 0)
            return;

        // build the query
        $queryString = 'UPDATE menu_items SET name="%s", description="%s", price="%s", position=%d WHERE id=%d;';
        $query = '';
        foreach($items as $i) {
            $query .= sprintf($queryString, $i['name'], $i['description'], $i['price'], $i['position'], $i['id']);
        }

        $stmt = $db->prepare($query);
        try {
            $stmt->execute();
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }
?>