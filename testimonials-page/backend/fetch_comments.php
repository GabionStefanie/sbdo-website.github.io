<?php
$User_id = 1;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $conn->prepare("SELECT Username, Stars, Review, created_at FROM REVIEWS JOIN account ON ? = account.User_ID ORDER BY created_at DESC");
$sql->bind_param('i', $User_id);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<div class='comment-rating'>";
        for ($i = 0; $i < $row["Stars"]; $i++) {
            echo "<span id='review-stars' class='star selected'>★</span>";
        }
        for ($i = $row["Stars"]; $i < 5; $i++) {
            echo "<span class='star'>★</span>";
        }
        echo "</div>";
        echo "<div class='comment-text'>" . $row["Review"] . "</div>";
        echo "<div class='comment-author'>" . ($row["Username"]) . "</div>";
        echo "<div class='comment-date'>" . $row["created_at"] . "</div>";
        echo "</div>";
    }
} else {
    echo "No comments yet.";
}
$conn->close();
?>
