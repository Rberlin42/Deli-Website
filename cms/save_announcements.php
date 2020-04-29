<?php
  include '../db-connect.php';
  $connection = openDatabaseConnection();

  if(is_null($connection)){
    echo 'Could not connect to database';
    http_response_code(500);
    return;
  }

  $_POST = json_decode(file_get_contents('php://input'), true);
  $announcements = $_POST['announcements'];


  // clear old announcements
  $clear_items = "DELETE FROM announcements;";
  $stmt = $connection->prepare($clear_items);
  $stmt->execute();

  // insert updated announcements
  $insert = "INSERT INTO announcements (title, description, position) VALUES";
  for($i = 0; $i < count($announcements); $i++) {
    $insert .= " ('" . $announcements[$i]['title'] . "', '" . $announcements[$i]['description'] . "', " . $i . "),";
  }
  $insert = substr($insert, 0, -1);
  $insert .= ";";
  $stmt = $connection->prepare($insert);
  $stmt->execute();

  $connection = null;
?>