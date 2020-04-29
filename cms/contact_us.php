<?php
  define('PAGE', 'CONTACT US');
  include_once('cms_auth_controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <title>B&D CMS - Contact Us</title>
</head>
<body>
    <?php include('resources/navbar.php'); ?>
    <div id="contact_us_group">
        <?php
            include_once('contact_us_controller.php');
            getMessages();
        ?>
    </div>
<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/popper.js/dist/popper.min.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    function deleteMessage(id) {
        console.log('TEST');
        const formData = new FormData();
        formData.append('method', 'DELETE');
        formData.append('msgid', id);
        fetch('contact_us_controller.php', {method: 'POST', body: formData});
        window.location.reload();
    }
</script>
</body>
</html>