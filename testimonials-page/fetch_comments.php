<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT rating, comment, anonymous, created_at FROM testimonials ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<div class='comment-rating'>";
        for ($i = 0; $i < $row["rating"]; $i++) {
            echo "<span class='star selected'>★</span>";
        }
        for ($i = $row["rating"]; $i < 5; $i++) {
            echo "<span class='star'>★</span>";
        }
        echo "</div>";
        echo "<div class='comment-text'>" . $row["comment"] . "</div>";
        echo "<div class='comment-author'>" . ($row["anonymous"] ? "Anonymous" : "User") . "</div>";
        echo "<div class='comment-date'>" . $row["created_at"] . "</div>";
        echo "</div>";
    }
} else {
    echo "No comments yet.";
}
$conn->close();
?>
