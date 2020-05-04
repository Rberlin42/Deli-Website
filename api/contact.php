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
        getEmails($db);
    }
    elseif($method == 'POST') {
        addEmail($db);
    }
    elseif($method == 'DELETE') {
        deleteEmail($db);
    }
    else {
        http_response_code(405);
    }
    $db = null;

    /**
     * Return a list of all emails
     */
    function getEmails($db) {
        $stmt = $db->prepare('SELECT * FROM contact_us;');
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
     * Add a new email to the db
     */
    function addEmail($db) {
        $email = json_decode(file_get_contents('php://input'), true);

        $stmt = $db->prepare('INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?);');
        try {
            $stmt->execute([$email['name'], $email['email'], $email['subject'], $email['message']]);
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    /**
     * Remove an email from the db
     */
    function deleteEmail($db) {
        if(!isset($_REQUEST['id'])) {
            http_response_code(400);
            return;
        }

        $id = $_REQUEST['id'];
        $stmt = $db->prepare('DELETE FROM contact_us WHERE id = ' . $id . ';');

        try {
            $stmt->execute();
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }

?>