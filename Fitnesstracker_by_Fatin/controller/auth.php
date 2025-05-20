<?php
session_start();

$valid_email = 'user@gmail.com';
$valid_password = 'user1234';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === $valid_email && $password === $valid_password) {
    $_SESSION['email'] = $email;

    header("Location: /webtech/learning-web-technologilearning-web-technologies-spring2024-2025-sec-A/fitness_tracker/Fitnesstracker_by_Fatin/dashboard.php");
    exit;
} else {
    header("Location: /Fitnesstracker_by_Fatin/views/login.php");
    exit;
}
?>