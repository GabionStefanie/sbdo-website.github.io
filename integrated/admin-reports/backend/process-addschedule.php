<?php

if (empty($_POST["appointment_date"])) {
    die("Date is required");
}

if (empty($_POST["appointment_time"])) {
    die("time is required");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$mysqli = new mysqli($servername, $username, $password, $dbname);

$status = "Available";
$sql = "INSERT INTO schedule (scheduleDate, scheduleTime, status)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if (! $stmt->prepare($sql)) {
    die("SQL error: ". $mysqli->error);
}

foreach (array_values($_POST["appointment_time"]) as $time) {
    $stmt->bind_param("sss", $_POST["appointment_date"], $time, $status);
    $stmt->execute();
}

header("Location:../addschedule-success.php");
exit;