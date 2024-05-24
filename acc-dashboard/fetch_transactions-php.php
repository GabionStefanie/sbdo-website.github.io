<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dental_office";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['patient_id'])) {
    $patient_id = (int)$_GET['patient_id'];
    
    // SQL query to fetch appointment details for a specific patient
    $sql = "
        SELECT 
            a.Appointment_ID, 
            a.Patient_ID, 
            a.Dentist_ID, 
            a.Service_ID, 
            a.Schedule_ID, 
            a.Appointment_Note, 
            a.Time_Created,
            s.scheduleDate, 
            s.scheduleTime, 
            s.Status as Schedule_Status
        FROM 
            appointment a
        LEFT JOIN 
            schedule s ON a.Schedule_ID = s.Schedule_ID
        WHERE 
            a.Patient_ID = ?
    ";
    
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('i', $patient_id); // 'i' indicates the type is integer
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Fetch and display the results
            while ($row = $result->fetch_assoc()) {
                echo "Appointment ID: " . htmlspecialchars($row['Appointment_ID']) . "<br>";
                echo "Service ID: " . htmlspecialchars($row['Service_ID']) . "<br>";
                echo "Schedule ID: " . htmlspecialchars($row['Schedule_ID']) . "<br>";
                echo "Appointment Note: " . htmlspecialchars($row['Appointment_Note']) . "<br>";
                echo "Time Created: " . htmlspecialchars($row['Time_Created']) . "<br>";
                echo "Schedule Date: " . htmlspecialchars($row['scheduleDate']) . "<br>";
                echo "Schedule Time: " . htmlspecialchars($row['scheduleTime']) . "<br>";
                echo "Schedule Status: " . htmlspecialchars($row['Schedule_Status']) . "<br><br>";
            }
        } else {
            echo "No appointments found for the specified patient ID.";
        }
        
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
} else {
    echo "Patient ID not provided.";
}
?>
