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
        getAnnouncements($db);
    }
    elseif($method == 'POST') {
        updateAll($db);
    }
    else {
        http_response_code(405);
    }
    $db = null;

    /**
     * Output a list of announcements
     */
    function getAnnouncements($db){
        $stmt = $db->prepare('SELECT * FROM announcements ORDER BY position;');

        try {
            $stmt->execute();
            echo json_encode($stmt->fetchAll());
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    /**
     * Add, delete and update announcements
     */
    function updateAll($db) {
        $input = json_decode(file_get_contents('php://input'), true);

        deleteAnnouncements($input['delete'], $db);
        $ids = addAnnouncements($input['add'], $db);
        updateAnnouncements($input['update'], $db);

        echo json_encode($ids);
    }

    /**
     * Delete announcements for given ids
     */
    function deleteAnnouncements($ids, $db) {
        if(count($ids) == 0)
            return;

        // build the query
        $query = 'DELETE FROM announcements WHERE id IN (';
        foreach($ids as $id) {
            $query .= $id . ',';
        }
        $query = rtrim($query, ',') . ');';

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
     * add new announcements
     * Return new ids
     */
    function addAnnouncements($announcements, $db) {
        if(count($announcements) == 0)
            return [];
        
        // build the query
        $query = 'INSERT INTO announcements (title, description, position) VALUES';
        foreach($announcements as $a) {
            $query .= '("' . $a['title'] . '","' . $a['description'] . '",' . $a['position'] . '),';
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
        return range($id, $id + count($announcements) - 1);
    }

    /**
     * Update given announcements
     */
    function updateAnnouncements($announcements, $db) {
        if(count($announcements) == 0)
            return [];
    
        // build the query
        $queryString = 'UPDATE announcements SET title="%s", description="%s", position=%d WHERE id=%d;';
        $query = '';
        foreach($announcements as $a) {
            $query .= sprintf($queryString, $a['title'], $a['description'], $a['position'], $a['id']);
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