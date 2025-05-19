<?php
session_start();

$valid_email = 'user@gmail.com';
$valid_password = 'user1234';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === $valid_email && $password === $valid_password) {
    $_SESSION['email'] = $email;

    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>