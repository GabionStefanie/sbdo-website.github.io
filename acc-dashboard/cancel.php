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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and validate appointment ID
    $appointmentId = isset($_POST["appointmentId"]) ? $_POST["appointmentId"] : null;

    if (!$appointmentId || !is_numeric($appointmentId)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid appointment ID"]);
        exit;
    }

    // Sanitize input data
    $appointmentId = mysqli_real_escape_string($conn, $appointmentId);

    // Perform SQL query to cancel the appointment
    $sql = "DELETE FROM appointment WHERE Appointment_ID = $appointmentId";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // OK
        echo json_encode(["message" => "Appointment canceled successfully"]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Error canceling appointment: " . $conn->error]);
    }
} else {
    // If the request method is not POST, return an error response
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method not allowed"]);
}
?>
