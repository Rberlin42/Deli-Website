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
        if(!(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']))) {
            http_response_code(400);
            header("Location: /contact_us.html?type=Fail");
            return;
        }

        $stmt = $db->prepare('INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?);');
        try {
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']]);
        }
        catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
            header("Location: /contact_us.html?type=Fail");
        }
        header("Location: /contact_us.html?type=Success");
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