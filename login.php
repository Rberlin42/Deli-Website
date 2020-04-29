<?php
    if(isset($_COOKIE['CMSCODE'])) {
        if(password_verify(getenv('CMSCODE'), $_COOKIE['CMSCODE'])) {
            setcookie("CMSCODE", password_hash(getenv('CMSCODE'), PASSWORD_DEFAULT),  time() + 86400, "/");
            header("Location: /cms/menu.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="resources/bd.css"/>
    <title>CMS Login</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="fail-alert" class="alert alert-danger" role="alert" style="display:none;">
        Incorrect Code entered!
    </div> 
    <div id="unauthorized" class="alert alert-warning" role="alert" style="display:none;">
        Unauthorized access to CMS, please login!
    </div> 
    <div class="container-fluid d-flex flex-column flex-fill align-items-center justify-content-center">
        <div class="card bg-dark">
            <form id="cmslogin" method="post" action="/backend-controllers/cms_login_controller.php">
                <div class="form-group">
                    <label for="cmscode" style="color:white;">Enter the CMS Code</label>
                    <input type="password" class="form-control" id="cmscode" placeholder="CMS Code" name="cmscode">
                </div>
                <button type="submit" class="btn btn-success">Sign In</button>
            </form>
        </div>
    </div>
</body>
<script>
    if (window.location.search.includes("Fail")) {
        document.querySelector("#fail-alert").style.cssText = "display: block;";
    }
    if (window.location.search.includes("Cookie")) {
        document.querySelector("#unauthorized").style.cssText = "display: block;";
    }
</script>
</html>