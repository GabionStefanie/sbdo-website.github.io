<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdodatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch monthly appointment data
$sql = "SELECT DAY(Time_Created) AS day, COUNT(*) AS appointment_count
        FROM appointment
        WHERE MONTH(Time_Created) = 5 AND YEAR(Time_Created) = 2024
        GROUP BY DAY(Time_Created)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store results in an array
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Output data as JSON
    echo json_encode($data);
} else {
    echo "No data found";
}

// Close connection
$conn->close();
?>
