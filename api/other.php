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
        getItem($db);
    }
    elseif($method == 'PUT') {
        updateItems($db);
    }
    else {
        http_response_code(405);
    }
    $db = null;

    /**
     * Get and echo the specified other item
     */
    function getItem($db) {
        if(!isset($_GET['id'])) {
            http_response_code(400);
            return;
        }

        $id = $_GET['id'];
        $stmt = $db->prepare('SELECT * FROM cms_data WHERE id = ?;');

        try {
            $stmt->execute([$id]);
            echo json_encode($stmt->fetchAll()[0]);
        }
        catch (Execute $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    /**
     * Update all the other items given
     */
    function updateItems($db) {
        $updates = json_decode(file_get_contents('php://input'), true);

        // build the query
        $queryString = 'UPDATE cms_data SET sectionText = "%s" WHERE id = %d;';
        $query = '';
        foreach($updates as $item) {
            $query .= sprintf($queryString, $item['info'], $item['id']);
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