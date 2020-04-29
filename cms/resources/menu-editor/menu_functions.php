<?php
include '../db-connect.php';
    function fetchSections($menu_type) {
        $connection = openDatabaseConnection();
        $section_query = "SELECT name FROM menu_sections WHERE type = ? ORDER BY position;";
        $stmt = $connection->prepare($section_query);
        $stmt->execute([$menu_type]);
        $i = 0;
        while($row = $stmt->fetch()) {
            if($i == 0)
                echo "<div href='#' class='list-group-item active mx-auto w-100'>";
            else
                echo "<div href='#' class='list-group-item'>";

            echo "<div class='d-flex w-100 justify-content-between align-items-center'>
                    <i class='fas fa-bars drag-handle'></i>
                    <input class='section-name form-control w-75' id='section-name_" . $i . "' type='text' value='" . $row['name'] . "' placeholder='Section Name'/>
                    <i class='far fa-times-circle delete'></i>
                </div></div>";
            
            $i++;
        }
        // Closes the db connection
        $connection = null;
    }

    function getAllSectionIds($menu_type) {
        $connection = openDatabaseConnection();
        $stmt = $connection->prepare("SELECT id FROM menu_sections WHERE type = ?;");
        $stmt->execute([$menu_type]);
        $sectionIds = array();
        while($row = $stmt->fetch()) {
            array_push($sectionIds, $row['id']);
        }
        return $sectionIds;
    }
    
    function generateCMSMenuItems($menu_type) {
        $sectionIds = getAllSectionIds($menu_type);
        for($i = 0; $i < count($sectionIds); $i++) {
            if($i == 0)
                echo "<div class='items selected-items list-group' id='section_" . $i . "'>";
            else
                echo "<div class='items list-group' id='section_" . $i . "'>";
            // fetch items for this section
            $items_query = "SELECT name, description, price FROM menu_items WHERE sectionID = ? ORDER BY position;";
            $connection = openDatabaseConnection();
            $stmt = $connection->prepare($items_query);
            $stmt->execute([$sectionIds[$i]]);
            while($row = $stmt->fetch($items)) {
                echo "<div class='item list-group-item d-flex w-100 justify-content-between align-items-center'>
                        <i class='fas fa-bars drag-handle'></i>
                        <div class='container w-75'>
                          <div class='row justify-content-between mb-1'>
                            <input class='item-name form-control col-6' type='text' value='" . $row['name'] . "' placeholder='Name'/>
                            <input class='item-price form-control col-3' type='text' value='" . $row['price'] . "' placeholder='Price'/>
                          </div>
                          <div class='row'>
                            <textarea class='item-description form-control w-100' placeholder='Description...'>" . $row['description'] . "</textarea>
                          </div>
                        </div>
                        <i class='far fa-times-circle delete'></i>
                      </div>";
            }

            echo "</div>";
        }
    
        $connection = null;
    }
?>