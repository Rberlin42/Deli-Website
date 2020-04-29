<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    require_once('../db-connect.php');
    $connection = openDatabaseConnection();
    $stmt = $connection->prepare("INSERT INTO contact_us(name, email, subject, message) VALUES (?, ?, ?, ?);");
    try {
        $stmt->execute([$_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']]);
        header("Location: /contact_us.php?type=Success");
        $connection = null;
        exit();
    } catch (PDOException $e) {
        header("Location: /contact_us.php?type=Fail");
        exit();
    }
} else {
    header("Location: /contact_us.php?type=Fail");
    exit();
}
?>