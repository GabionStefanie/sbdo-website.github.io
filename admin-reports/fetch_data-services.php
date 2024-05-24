<?php
// Database connection
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

// Function to execute SQL query and fetch data
function fetchData($query) {
    global $conn;
    $result = $conn->query($query);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Fetch monthly, weekly, and daily availed services
$monthlyServices = fetchData("SELECT Service_Name, COUNT(*) AS Monthly_Count FROM appointment JOIN service ON appointment.Service_ID = service.Service_ID WHERE MONTH(Time_Created) = 5 AND YEAR(Time_Created) = 2024 GROUP BY Service_Name");
$weeklyServices = fetchData("SELECT Service_Name, COUNT(*) AS Weekly_Count FROM appointment JOIN service ON appointment.Service_ID = service.Service_ID WHERE WEEK(Time_Created) = 20 AND YEAR(Time_Created) = 2024 GROUP BY Service_Name");
$dailyServices = fetchData("SELECT Service_Name, COUNT(*) AS Daily_Count FROM appointment JOIN service ON appointment.Service_ID = service.Service_ID WHERE DATE(Time_Created) = '2024-05-24'");

// Fetch top 5 services availed
$topServices = fetchData("SELECT Service_Name, COUNT(*) AS Total_Count FROM appointment JOIN service ON appointment.Service_ID = service.Service_ID GROUP BY Service_Name ORDER BY Total_Count DESC LIMIT 5");

// Close connection
$conn->close();
?>
