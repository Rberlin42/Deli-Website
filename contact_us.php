<?php
    define('PAGE', 'CONTACT US');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="resources/bd.css"/>
    <title>Contact Us</title>
</head>
<body>
    <?php include('resources/navbar.php');?>
    <div id="fail-alert" class="alert alert-danger" role="alert" style="display:none;">
        We're sorry, something went wrong please try again later!
    </div> 
    <div id="success-alert" class="alert alert-success" role="alert" style="display:none;">
        Message succesfully sent, we'll get back to you as soon as possible!
    </div> 
    <div class="container">
        <form id="contact_us" method="post" action="backend-controllers/contact_us_controller.php">
            <h3 class="text-center">Contact Us</h3>
            <h6 class="text-center">Write us a message or give us a call at (516) 681-1670</h5>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required/>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required/>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
    <script>
        if (window.location.search.includes("Fail")) {
            document.querySelector("#fail-alert").style.cssText = "display: block;";
        }
        if (window.location.search.includes("Success")) {
            document.querySelector("#success-alert").style.cssText = "display: block;";
        }
    </script>
    <script src="https://kit.fontawesome.com/b795fdd398.js" crossorigin="anonymous"></script>
</body>
</html>