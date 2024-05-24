<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$user_id = $_SESSION['user_id'];
$sql = "SELECT Username, Email, PhoneNumber, ProfilePicture FROM account WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();
    $username = $user['Username'];
    $email = $user['Email'];
    $phone_number = $user['PhoneNumber'];
    // Assuming ProfilePicture is a blob, you might need to handle it differently
    $profile_picture = $user['ProfilePicture'];
} else {
    // Handle case where user is not found
    echo "User not found.";
    exit();
}
?>
