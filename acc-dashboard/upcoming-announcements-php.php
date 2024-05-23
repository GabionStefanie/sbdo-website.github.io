<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdodatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select upcoming appointments
$sql = "SELECT 
    appointment.Appointment_ID,
    appointment.Appointment_Note,
    appointment.Time_Created,
    schedule.scheduleDate AS Appointment_Date,
    appointment.Appointment_Time,
    patient.Name AS Patient_Name,
    patient.Phone AS Patient_Phone,
    patient.Email AS Patient_Email,
    appointment.Amount
FROM 
    appointment
JOIN 
    patient ON appointment.Patient_ID = patient.Patient_ID
JOIN 
    schedule ON appointment.Schedule_ID = schedule.Schedule_ID
WHERE 
    schedule.scheduleDate >= CURDATE()
ORDER BY 
    schedule.scheduleDate ASC";

$result = $conn->query($sql);

// Check if appointments exist
if ($result->num_rows > 0) {
    // Start table
    echo "<table>";
    // Table headers
    echo "<tr><th>NAME</th><th>TYPE OF APPOINTMENT</th><th>DATE CREATED</th><th>DATE OF APPOINTMENT</th><th>AMOUNT</th></tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Start table row
        echo "<tr>";
        
        // Output appointment details within table cells
        echo "<td>" . $row["Patient_Name"] . "</td>";
        echo "<td>" . $row["Appointment_Note"] . "</td>";
        echo "<td>" . date("m/d/Y", strtotime($row["Time_Created"])) . "</td>";
        echo "<td>" . date("m/d/Y", strtotime($row["Appointment_Date"])) . "</td>";
        echo "<td>" . $row["Amount"] . "</td>";
        
        // End table row
        echo "</tr>";
    }
    // Close table
    echo "</table>";
} else {
    // If no appointments, display message with stylized CSS
    echo "<div class='no-appointments'>No upcoming appointments</div>";
}
?>
