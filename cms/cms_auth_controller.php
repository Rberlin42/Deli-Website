<?php
    if (!isset($_COOKIE['CMSCODE'])) {
        header("Location: /login.php?type=Cookie");
        exit();
    }
    if(!(password_verify(getenv('CMSCODE'), $_COOKIE['CMSCODE']))) {
        // Deletes the bad cookie they have
        setcookie("CMSCODE", "",  time() - 3000000, "/");
        header("Location: /login.php?type=Cookie");
        exit();
    }
?>