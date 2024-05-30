<?php
$conn = new mysqli("localhost", "root", "", "sbdodatabase");

// Get the appointment date and time slots from the user input
$appointment_date = $_POST["appointment_date"];
$appointment_time = $_POST["appointment_time"];

// Check if the appointment date and time slots are already in the database
$sql = "SELECT * FROM schedule WHERE scheduleDate =? AND scheduleTime IN (";
foreach ($appointment_time as $time) {
    $sql.= "'". $time. "',";
}
$sql = rtrim($sql, ",");
$sql.= ")";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $appointment_date);
$stmt->execute();
$result = $stmt->get_result();

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);