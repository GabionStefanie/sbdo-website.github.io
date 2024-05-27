<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stars = $_POST['rating'];
    $review = $_POST['comment'];

    if (isset($_POST['anonymous'])) {
        $UserID = null;
        $UserName = "Anonymous";
    } else {
        $UserID = $_COOKIE["User_ID"];
        $sql = "SELECT Username 
        FROM account
        LEFT JOIN reviews USING (User_ID)
        WHERE User_ID = '$UserID' ";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $UserName = $result['Username'];
    }

    $stmt = $conn->prepare("INSERT INTO REVIEWS (Stars, Review, User_ID) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $stars, $review, $UserID);

    date_default_timezone_set('Asia/Manila');
    $dateTime = new DateTime(date("Y-m-d H:i:s"));
    $formattedDate = $dateTime->format("M d, Y g:i A");

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "comment" => [
                "rating" => $stars,
                "comment" => $review,
                "anonymous" => $UserName,
                "created_at" => $formattedDate
            ]
        ];
    } else {
        $response["message"] = $stmt->error;
    }

    $stmt->close();
}

$conn->close();

// header('Content-Type: application/json');
echo json_encode($response);
