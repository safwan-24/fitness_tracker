<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../model/dbconnection.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    die("All fields are required.");
}

$sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    header("Location: contact.php?msg=Thank you for contacting us!");
    exit;
} else {
    die("Submission failed: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
