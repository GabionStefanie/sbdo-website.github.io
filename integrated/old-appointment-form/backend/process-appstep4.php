<?php

if (empty($_POST["covid"])) {
    die("Covid Vaccination status is required");
}

if (empty($_POST["symptoms"])) {
    die("Symptoms status is required");
}

$mysqli = new mysqli("localhost", "root", "", "sbdoDatabase");

$stmt = $mysqli->stmt_init();

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save form inputs in session
    $_SESSION["covid"] = $_POST["covid"];
    $_SESSION["symptoms"] = array_values($_POST["symptoms"]);
    header('Location: ../payments.php');
}

$mysqli->close();
?>