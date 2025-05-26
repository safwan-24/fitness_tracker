<?php


include_once '../model/contact.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    die("All fields are required.");
}

if (saveContactMessage($name, $email, $message)) {
    header("Location: ../views/contact.php?msg=Thank you for contacting us!");
    exit;
} else {
    die("Failed to send message.");
}
