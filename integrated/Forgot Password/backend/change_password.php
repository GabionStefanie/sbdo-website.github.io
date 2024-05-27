<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["password"], $_POST["confirm_password"], $_SESSION["email"])) {
        $newPassword = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];
        $email = $_SESSION["email"];

        if ($newPassword !== $confirmPassword) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
            exit;
        }

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            echo json_encode(['success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error()]);
            exit;
        }

        // Check if the provided password matches the current password in the database
        $sql = "SELECT Password FROM ACCOUNT WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Preparation failed: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($currentPassword);
            $stmt->fetch();

            // Verify if the provided password matches the current password
            if (password_verify($newPassword, $currentPassword)) {
                echo json_encode(['success' => false, 'message' => 'The new password cannot be the same as the current password']);
            } else {
                // Passwords don't match, proceed with updating
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // Update the password in the database
                $sqlUpdate = "UPDATE ACCOUNT SET Password = ? WHERE Email = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                if (!$stmtUpdate) {
                    echo json_encode(['success' => false, 'message' => 'Preparation failed: ' . $conn->error]);
                    exit;
                }

                $stmtUpdate->bind_param("ss", $hashedPassword, $email);

                if ($stmtUpdate->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update password']);
                }

                $stmtUpdate->close();
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
