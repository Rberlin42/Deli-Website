<?php
function getMenu($type) {
    require_once('../db-connect.php');
    $connection = openDatabaseConnection();
    $query = "SELECT mi.name, mi.description, ms.name as section, mi.price, mi.position
    FROM
    menu_items mi,
    menu_sections ms
    WHERE
    ms.id = mi.sectionID AND
    ms.type = ?
    ORDER BY
    ms.position, mi.position";  
    $stmt = $connection->prepare($query);
    $stmt->execute([$type]);
    return json_encode($stmt->fetchAll());  
}
if (isset($_GET['menu_type'])) {
    echo getMenu($_GET['menu_type']);
}
?>