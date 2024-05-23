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

// Assuming patient_id is passed as a GET parameter
if (isset($_GET['patient_id'])) {
    $patient_id = (int)$_GET['patient_id'];
    
    $sql = "SELECT date, name, amount, status FROM transactions WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $transactions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $transactions[] = $row;
            }
        }
        
        $stmt->close();
        $conn->close();
        
        header('Content-Type: application/json');
        echo json_encode($transactions);
    } else {
        echo json_encode(["error" => "Failed to prepare the SQL statement."]);
    }
} else {
    echo json_encode(["error" => "Patient ID is not set."]);
}
?>
