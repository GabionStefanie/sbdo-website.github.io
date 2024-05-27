<?php
session_start();

// Database credentials
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "sbdoDatabase";

// Create a connection to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profilePicture'])) {
    $file = $_FILES['profilePicture'];
    $target_dir = "uploads/";

    // Check if the 'uploads' directory exists, create it if not
    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            echo "Error creating directory '$target_dir'.";
            return;
        }
    }

    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        // Check file size (5MB maximum)
        if ($file["size"] <= 5000000) {
            // Allow certain file formats
            if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                // Move the uploaded file to the 'uploads' directory, overwrite if it already exists
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    // Prepare SQL statement to update profile picture
                    $sql = "UPDATE ACCOUNT SET ProfilePicture = ? WHERE User_ID = ?";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("si", $target_file, $_SESSION["userID"]);
                        if ($stmt->execute()) {
                            echo "The file ". basename($file["name"]). " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                        $stmt->close();
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            echo "Sorry, your file is too large.";
        }
    } else {
        echo "File is not an image.";
    }
}

// Fetch the current profile picture
$sql = "SELECT ProfilePicture FROM ACCOUNT WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $_SESSION["userID"]);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profilePicturePath = $row['ProfilePicture'];
        } else {
            echo "No results found.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
