<?php
  define("MENU_TYPE", 'special');
  define('PAGE', 'SPECIALS');
  include_once('cms_auth_controller.php')
?>

<!doctype html>
<html>

  <head>
    <title>B&D CMS - Specials</title>
    <?php include('resources/menu-editor/includes.php'); ?>
  </head>
  
  <body>
    <?php
      include('resources/navbar.php');
      include('resources/menu-editor/menu-editor.php');
    ?>
  </body>

</html>