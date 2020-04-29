<?php
    include_once( dirname(__FILE__) . '/../db-connect.php');

    function getAbout() {
        return getOther('about');
    }

    function getHours() {
        return getOther('hours');
    }

    function getCateringInfo() {
        return getOther('catering');
    }

    function getOther($section) {
        $connection = openDatabaseConnection();
        $query = "SELECT sectionText FROM cms_data WHERE sectionName = '" . $section . "';";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn(0);
        $connection = null;
        return trim($result);
    }

?>