<?php
if (isset($_POST["logout"])) {
    setcookie("User_ID", "", -1, "/");
    unset($_COOKIE["User_ID"]);
    header("Location: ../static-home-page/index.php");
}
