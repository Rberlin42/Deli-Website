<?php
  define("MENU_TYPE", 'catering');
  define('PAGE', 'CATERING');
  include_once('cms_auth_controller.php');
?>

<!doctype html>
<html>

  <head>
    <title>B&D CMS - Catering</title>
    <?php include('resources/menu-editor/includes.php'); ?>
  </head>
  
  <body>
    <?php
      include('resources/navbar.php');
      include('resources/menu-editor/menu-editor.php');
    ?>
  </body>

</html>