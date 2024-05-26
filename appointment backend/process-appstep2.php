<?php

if (empty($_POST["complaint"])) {
    die("Chief complaint is required");
}

if (empty($_POST["details"])) {
    die("Details of chief complaint are required");
}

if (empty($_POST["dentalpain"])) {
    die("Dental pain response is required");
}

if (empty($_POST["painlevel"])) {
    die("Pain level is required");
}

if (empty($_POST["dentaltrauma"])) {
    die("Dental trauma response is required");
}

if (empty($_POST["bleedingtissues"])) {
    die("Bleeding from soft tissues response is required");
}

$mysqli = require __DIR__ . "/database.php";

$stmt = $mysqli->stmt_init();

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save form inputs in session
    $_SESSION["complaint"] = $_POST["complaint"];
    $_SESSION["details"] = $_POST["details"];
    $_SESSION["dentalpain"] = $_POST["dentalpain"];
    $_SESSION["painlevel"] = $_POST["painlevel"];
    $_SESSION["dentaltrauma"] = $_POST["dentaltrauma"];
    $_SESSION["bleedingtissues"] = $_POST["bleedingtissues"];
    header('Location: appstep3.php');
}

$mysqli->close();