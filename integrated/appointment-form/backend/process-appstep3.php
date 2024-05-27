<?php

if (empty($_POST["diabetes"])) {
    die("Dental Pain status is required");
}

if (empty($_POST["heartconditions"])) {
    die("Heart conditions status is required");
}

if (empty($_POST["hypertension"])) {
    die("Hypertension status is required");
}

if (empty($_POST["maintenance"])) {
    die("Maintenance status is required");
}

if (empty($_POST["systolicpressure"])) {
    die("Systolic Pressure status is required");
}

if (empty($_POST["diastolicpressure"])) {
    die("Diastolic Pressure status is required");
}

$mysqli = new mysqli("localhost", "root", "", "sbdoDatabase");

$stmt = $mysqli->stmt_init();

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save form inputs in session
    $_SESSION["diabetes"] = $_POST["diabetes"];
    $_SESSION["heartconditions"] = $_POST["heartconditions"];
    $_SESSION["hypertension"] = $_POST["hypertension"];
    $_SESSION["medallergen"] = $_POST["medallergen"];
    $_SESSION["maintenance"] = $_POST["maintenance"];
    $_SESSION["systolicpressure"] = $_POST["systolicpressure"];
    $_SESSION["diastolicpressure"] = $_POST["diastolicpressure"];
    $_SESSION["medicalconditions"] = $_POST["medicalconditions"];
    header('Location: ../appstep4.php');
}

$mysqli->close();
?>