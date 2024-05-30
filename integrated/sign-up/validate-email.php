<?php
$conn = new mysqli("localhost", "root", "", "sbdodatabase");

$email = $_GET["email"] ?? "";

$sql = "SELECT * FROM account WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);