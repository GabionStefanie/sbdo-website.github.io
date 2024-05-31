<?php

if (empty($_POST["appointment_date"])) {
    die("Date is required");
}

if (empty($_POST["appointment_time"]) || !is_array($_POST["appointment_time"])) {
    die("Time is required and must be an array");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

// Create a new mysqli object with database connection parameters
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$status = "Available";
$sql = "INSERT INTO schedule (scheduleDate, scheduleTime, status) VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

// Bind the parameters to the SQL query
$stmt->bind_param("sss", $scheduleDate, $scheduleTime, $status);

foreach ($_POST["appointment_time"] as $time) {
    // Validate time format (HH:MM:SS)
    if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $time)) {
        die("Invalid time format: $time");
    }

    $scheduleDate = $_POST["appointment_date"];
    $scheduleTime = $time;

    // Execute the statement
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
}

// Close the statement and connection
$stmt->close();
$mysqli->close();

// Redirect to success page
header("Location: ../addschedule-success.php");
exit;

?>
