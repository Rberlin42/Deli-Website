<?php
  include '../../../db-connect.php';
  $connection = openDatabaseConnection();

  if(is_null($connection)){
    echo 'Could not connect to database';
    http_response_code(500);
    return;
  }

  $_POST = json_decode(file_get_contents('php://input'), true);
  $sections = $_POST['sections'];
  $type = $_POST['type'];
  
  // clear old menu
  $clear_items = "DELETE FROM menu_items WHERE sectionID in (SELECT id FROM menu_sections WHERE type = ?);";
  $clear_sections = "DELETE FROM menu_sections WHERE type = ?;";
  $stmt = $connection->prepare($clear_items);
  $stmt->execute([$type]);
  $stmt = $connection->prepare($clear_sections);
  $stmt->execute([$type]);

  // insert updated menu
  foreach($sections as $i => $section) {
    $insert_section = "INSERT INTO menu_sections (name, type, position) VALUES (?, ?, ?);";
    $stmt = $connection->prepare($insert_section);
    $stmt->execute([$section['name'], $type, $i]);
    $id = $connection->lastInsertId();
    insert_items($section['items'], $id, $connection);
  }

  function insert_items($items, $sectionID, $db) {
    $insert_items = "INSERT INTO menu_items (name, description, sectionID, price, position) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($insert_items);
    foreach($items as $i => $item) {
      $stmt->execute([$item['name'], $item['description'], $sectionID, $item['price'], $i]);
    }
  }

  echo 'Saved successfully';
  $connection = null;
?>