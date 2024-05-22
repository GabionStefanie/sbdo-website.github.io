<?php
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

$response = ["success" => false, "message" => "Something went wrong."];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stars = $_POST['rating'];
    $review = $_POST['comment'];
    $Anonymous = $_POST['anonymous'];

    if($Anonymous == 'true'){
        $UserID = null; 
    }
    else{
        $UserID = 1; // dummy user id put session here
    }

    $stmt = $conn->prepare("INSERT INTO REVIEWS (Stars, Review, User_ID) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $stars, $review, $UserID);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "comment" => [
                "rating" => $stars,
                "comment" => $review,
                "anonymous" => $UserID,
                "created_at" => date("Y-m-d H:i:s")
            ]
        ];
    } else {
        $response["message"] = $stmt->error;
    }

    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
