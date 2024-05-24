<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdodatabase"; // Change this to your actual database name

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
            CONCAT(p.Name) AS Full_Name,
            a.Appointment_Note AS Appointment_Type,
            a.Time_Created AS Date_Created,
            s.scheduleDate AS Date_of_Appointment,
            a.Service_ID AS Amount_Paid
        FROM 
            appointment a
        INNER JOIN 
            patient p ON a.Patient_ID = p.Patient_ID
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
            // Display the results in a table
            echo "<table border='1'>";
            echo "<tr><th>Full Name</th><th>Type of Appointment</th><th>Date Created</th><th>Date of Appointment</th><th>Amount Paid</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Full_Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Appointment_Type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date_Created']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date_of_Appointment']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Amount_Paid']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
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
