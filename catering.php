<?php
    define('PAGE', 'CATERING');
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
        <div class="container mt-5 p-0">
            <div class="col">
                <h2>B&D Catering</h2>
                <p>
                    <?php
                        include("cms/other_controller.php");
                        echo getCateringInfo();
                    ?>
                </p>
            </div>
            <hr/>
            <div id="cater-hold" class="col mt-5 p-0">
                <div id="container p-0">
                    <div>
                        <h2 class="menu_header text-center text-sm-left mb-5">Catering Menu</h2>
                        <div id="catering" class="container p-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-dark" id="footer">
            <div class="container">     
                <p class="text-center my-2">Copyright © 2020 B&D Deli</p>
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