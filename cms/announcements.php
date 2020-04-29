<?php
  define('PAGE', 'ANNOUNCEMENTS');
  define('SAVE_METHOD', 'save_announcements');
  require_once('announcement_controller.php');
  include_once('cms_auth_controller.php');
?>

<!doctype html>
<html>

  <head>
    <title>B&D CMS - Announcements</title>
    <link rel="stylesheet" type="text/css" href="/cms/resources/style.css">
    <link rel="stylesheet" type="text/css" href="/cms/resources/announcements-style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b795fdd398.js" crossorigin="anonymous"></script>
    <script src="/node_modules/sortablejs/Sortable.js"></script>
    <script src="/cms/resources/announcement-script.js"></script>
  </head>
  
  <body>
    <?php include('resources/navbar.php'); ?>

    <section class="container mt-5" id="announcements-container">
        <div class="list-group w-75 mx-auto" id="announcements">
          <?php generateCMSAnnouncements(); ?>
        </div>
        <button class="list-group-item list-group-item-action text-center bg-light w-75 mx-auto" id="add" onclick="addAnnouncement()">Add Section</button>
    </section>

    <?php include('resources/savebar.php'); ?>
  </body>
</html>