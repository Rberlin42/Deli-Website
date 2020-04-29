<?php
    define('PAGE', 'MENU');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>B&D Deli</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="resources/bd.css"/>
    </head>
    <body>
        <?php include('resources/navbar.php');?>
        <div class="col col-lg-2 sticky-top float-left mt-5 d-none d-lg-block" id="sections">
            <nav class="nav flex-column" id="sidenav">
                <h2>Deli Menu</h2>
            </nav>
        </div>
        <div class="col-12 col-lg-10 d-flex justify-content-between p-0 mt-5" id="main">
            <div id="regular" class="container p-0" data-spy="scroll" data-target="#sidenav" data-offset="0">
            </div>
        </div>

        <footer class="bg-dark" id="footer">
            <div class="container">     
                <p class="text-center my-2">Copyright © 2019 B&D Deli</p>
                <p class="text-center my-2"><a href="login.php">Admin Login</a></p>
            </div>
        </footer>
    </body>

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="frontend-controllers/menu.js"></script>
    <script src="https://kit.fontawesome.com/b795fdd398.js" crossorigin="anonymous"></script>
</html>