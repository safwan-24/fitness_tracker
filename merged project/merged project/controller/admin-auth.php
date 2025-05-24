<?php
session_start();

// Hardcoded admin credentials (replace with your own)
$admin_email = "admin@gmail.com";
$admin_password = "admin123";

// Get form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Check credentials
if ($email === $admin_email && $password === $admin_password) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_email'] = $admin_email;
    header("Location:/webtech/learning-web-technologilearning-web-technologies-spring2024-2025-sec-A/fitness_tracker/Fitnesstracker_by_Fatin/views/admin-dashboard.php");

    exit;
}

// If authentication fails
header('Location:/Fitnesstracker_by_Fatin/views/admin-login.php');
exit;
?>