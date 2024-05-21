<?php
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

$response = ["success" => false, "message" => "Something went wrong."];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $anonymous = isset($_POST['anonymous']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO testimonials (rating, comment, anonymous) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $rating, $comment, $anonymous);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "comment" => [
                "rating" => $rating,
                "comment" => $comment,
                "anonymous" => $anonymous,
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
