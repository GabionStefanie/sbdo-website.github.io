<?php

if (empty($_POST["appointment_date"])) {
    die("Date and time is required");
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$mysqli = new mysqli($servername, $username, $password, $dbname);


$status = "Available";
$sql = "INSERT INTO schedule (scheduleDateTime,status)
        VALUES (?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ss",
                  $_POST["appointment_date"],
                  $status);

if ($stmt->execute()) {

    header("Location: ../addschedule-success.php");
    exit;
    
} 