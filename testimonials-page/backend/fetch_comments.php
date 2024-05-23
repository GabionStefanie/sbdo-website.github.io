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

$sql = "SELECT Username, Stars, Review, created_at 
FROM REVIEWS
LEFT JOIN account USING (User_ID)
ORDER BY created_at DESC";
$result = (mysqli_query($conn, $sql));

// $sql->bind_param('i', $User_id);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dateTime = new DateTime($row["created_at"]);
        $formattedDate = $dateTime->format("M d, Y g:i A");

        echo "<div class='comment'>";
        echo "<div class='comment-rating'>";
        for ($i = 0; $i < $row["Stars"]; $i++) {
            echo "<span id='review-stars' class='star selected'>★</span>";
        }
        for ($i = $row["Stars"]; $i < 5; $i++) {
            echo "<span class='star'>★</span>";
        }
        echo "</div>";
        echo "<div class='comment-text'><pre>" . $row["Review"] . "</pre></div>";

        if ($row["Username"] == null) {
            $row["Username"] = "Anonymous";
        }

        echo "<div class='comment-author'>" . ($row["Username"]) . "</div>";
        echo "<div class='comment-date'>" . $formattedDate . "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='comment'>No comments yet.</div>";
}
$conn->close();
