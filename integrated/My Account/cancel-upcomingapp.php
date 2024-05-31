<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['agree']) && $_POST['agree'] === 'on') {
        $appointment_id = $_POST['AppointmentID']; // Replace with actual appointment ID from session or other means

        $sql = "UPDATE patient p JOIN account ac USING(User_ID) JOIN appointment ap ON ap.User_ID = ac.User_ID SET patient_status = 'cancelled' WHERE Appointment_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appointment_id);

        if ($stmt->execute() === TRUE) {
            echo "Appointment cancelled successfully";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "You must agree to cancel the appointment.";
    }
} else {
    echo "Method not allowed";
}

$conn->close();
?>
