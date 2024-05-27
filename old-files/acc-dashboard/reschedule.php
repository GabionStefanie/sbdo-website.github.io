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
    // Retrieve new date and time from the request and perform input validation
    $newDate = isset($_POST["newDate"]) ? $_POST["newDate"] : null;
    $newTime = isset($_POST["newTime"]) ? $_POST["newTime"] : null;

    if (!$newDate || !$newTime) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "New date and time are required"]);
        exit;
    }

    // Sanitize input data
    $newDate = mysqli_real_escape_string($conn, $newDate);
    $newTime = mysqli_real_escape_string($conn, $newTime);

    // Perform SQL query to update the appointment with new date and time
    $sql = "UPDATE appointment SET Appointment_Date = '$newDate', Appointment_Time = '$newTime' WHERE Appointment_ID = $appointmentId";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // OK
        echo json_encode(["message" => "Appointment rescheduled successfully"]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Error updating appointment: " . $conn->error]);
    }
} else {
    // If the request method is not POST, return an error response
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method not allowed"]);
}
?>
