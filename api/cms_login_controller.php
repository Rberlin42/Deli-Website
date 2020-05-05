<?php
    if ($_POST['cmscode'] == getenv("CMSCODE")) {
        setcookie("CMSCODE", password_hash($_POST['cmscode'], PASSWORD_DEFAULT),  time() + 86400, "/");
        header("Location: /cms/menu");
    } else {
        header("Location: /login?type=Fail");
    }
?>