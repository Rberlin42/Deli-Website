<?php
    define('PAGE', 'HOME');
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
        <div class="container px-sm-0">
            <div id="announcements" class="row mt-5 border-bottom">
                <div class="col">
                    <?php
                        include("cms/announcement_controller.php");
                        echo getAnnouncements();
                    ?>
                </div>
                <p id="announce-index"></p>
            </div>
            <div class="row pb-5">
                <div id="welcome" class="col-lg mr-lg-5 pr-lg-5 pt-5">
                    <h2>Welcome to B&D Deli.</h1>
                    <p class="welcome-blurb">
                        <?php
                            include("cms/other_controller.php");
                            echo getAbout();
                        ?>
                    </p>
                    <img id="about-photo" class="mb-5 mb-lg-0" src="resources/deliphoto.jpg" alt="b&d deli">
                </div>
                <div id="specials-container" class="col-lg mt-5 mt-lg-0 ml-lg-5 pl-lg-5">
                    <h2 class="menu_header text-center text-md-left mb-5">Today's Specials</h2>
                    <div id="specials" class="container p-0"></div>
                </div>
            </div>

            <div id="info-row" class="row my-5 text-center text-md-right">
                <div id="find-us" class="col-md pr-md-5">
                    <h4>Find Us:</h4>
                    <p>
                    667A Old Country Rd<br/>
                    Plainview, NY 11803
                    </p>

                    <h4 class="mt-5">Hours:</h4>
                    <p>
                        <?php
                            echo nl2br(getHours());
                        ?>
                    </p>

                    <h4 class="mt-5">Contact Info:</h4>
                    <p>
                    <i class="fas fa-phone"></i>
                    (516) 681-1670
                </div>
                <div class="col-md p-0 pl-md-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12086.197049863888!2d-73.4883472!3d40.7719374!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4e95651594d21b85!2sB%20%26%20D%20Deli%20%26%20Catering!5e0!3m2!1sen!2sus!4v1576804033806!5m2!1sen!2sus" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
        <footer class="bg-dark" id="footer">
            <div class="container">     
                <p class="text-center my-2">Copyright © 2019 B&D Deli</p>
                <p class="text-center my-2"><a href="login.php">Admin Login</a></p>
            </div>
        </footer>
        <script src="/node_modules/jquery/dist/jquery.min.js"></script>
        <script src="/node_modules/popper.js/dist/popper.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="frontend-controllers/menu.js"></script>
        <script type="text/javascript" src="resources/index.js"></script>
        <script src="https://kit.fontawesome.com/b795fdd398.js" crossorigin="anonymous"></script>
    </body>
</html>