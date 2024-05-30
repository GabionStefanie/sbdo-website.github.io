<?php
// get_times.php

// Establish database connection
$conn = new mysqli("localhost", "root", "", "sbdoDatabase");

// Check for errors in connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if date parameter is set
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Prepare SQL query to fetch available times for the selected date
    $query = "SELECT DISTINCT scheduleTime FROM schedule WHERE scheduleDate = ? AND status = 'available'";
    
    // Prepare statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedDate);
    
    // Execute statement
    $stmt->execute();
    
    // Bind result variables
    $stmt->bind_result($scheduleTime);

    // Fetch available times
    $times = array();
    while ($stmt->fetch()) {
        $times[] = $scheduleTime;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();

    // Output available times as JSON
    echo json_encode($times);
} else {
    // If date parameter is not set, return empty array
    echo json_encode([]);
}
?>
