<?php
    if ($_POST['cmscode'] == getenv("CMSCODE")) {
        setcookie("CMSCODE", password_hash($_POST['cmscode'], PASSWORD_DEFAULT),  time() + 86400, "/");
        header("Location: /cms/menu.php");
    } else {
        header("Location: /login.php?type=Fail");
    }
?>