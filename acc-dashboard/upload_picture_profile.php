<?php
header('Content-Type: application/json');

// Check if a file was uploaded
if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/profile_pictures/';
    $fileName = basename($_FILES['profilePicture']['name']);
    $uploadFilePath = $uploadDir . $fileName;

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file to the desired location
    if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFilePath)) {
        echo json_encode(['success' => true, 'message' => 'Profile picture uploaded successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error.']);
}
?>
