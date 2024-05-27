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
    a.Appointment_ID,
    a.Service_ID AS `Appointment Type`,
    a.Time_Created AS `Time Created`,
    s.scheduleDateTime AS `Appointment Date`,
    patient.Name AS `Patient Name`,
    patient.Phone AS `Patient Phone`,
    patient.Email AS `Patient Email`,
    p.Amount AS `Amount`
FROM 
    appointment a
JOIN 
    PATIENT ON a.Patient_ID = patient.Patient_ID
JOIN 
    SCHEDULE s ON a.Schedule_ID = s.Schedule_ID
JOIN 
    RECORD r ON a.Appointment_ID = r.Appointment_ID
JOIN
    PAYMENT p ON r.PaymentDetails_ID = p.PaymentDetails_ID
WHERE 
    s.scheduleDateTime >= CURDATE()
ORDER BY 
    s.scheduleDateTime ASC";

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
        echo "<td>" . $row["Patient Name"] . "</td>";
        echo "<td>" . $row["Appointment Type"] . "</td>";
        echo "<td>" . date("m/d/Y", strtotime($row["Time Created"])) . "</td>";
        echo "<td>" . date("m/d/Y", strtotime($row["Appointment Date"])) . "</td>";
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
