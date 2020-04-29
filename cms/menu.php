<?php
  define("MENU_TYPE", 'regular');
  define('PAGE', 'MENU');
  include_once('cms_auth_controller.php');
?>

<!doctype html>
<html>

  <head>
    <title>B&D CMS - Menu</title>
    <?php include('resources/menu-editor/includes.php'); ?>
  </head>
  
  <body>
    <?php
      include('resources/navbar.php');
      include('resources/menu-editor/menu-editor.php');
    ?>
  </body>

</html>