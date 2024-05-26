<?php

if (empty($_POST["covid"])) {
    die("Covid Vaccination status is required");
}

if (empty($_POST["symptoms"])) {
    die("Symptoms status is required");
}

$mysqli = require __DIR__ . "/database.php";

$stmt = $mysqli->stmt_init();

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save form inputs in session
    $_SESSION["covid"] = $_POST["covid"];
    $_SESSION["symptoms"] = $_POST["symptoms"];
    header('Location: payments-html.php');
}

$mysqli->close();
?>