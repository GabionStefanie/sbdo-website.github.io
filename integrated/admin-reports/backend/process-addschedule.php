<?php

if (empty($_POST["appointment_date"])) {
    die("Date is required");
}

if (empty($_POST["appointment_time"])) {
    die("Time is required");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$status = "Available";
$sql = "INSERT INTO schedule (scheduleDate, scheduleTime, status) VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

foreach ($_POST["appointment_time"] as $time) {
    $scheduleDateTime = $_POST["appointment_date"] . ' ' . $time;
    $stmt->bind_param("sss", $scheduleDate, $scheduleTime, $status);
    $stmt->execute();
}

$stmt->close();
$mysqli->close();

header("Location: ../addschedule-success.php");
exit;
?>
