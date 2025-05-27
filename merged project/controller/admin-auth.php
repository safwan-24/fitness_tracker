<?php
session_start();
require_once('../model/Admin.php'); // correct the path if needed

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($admin->login($email, $password)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header('Location: ../views/admin-dashboard.php'); // adjust path if needed
        exit();
    } else {
        $_SESSION['login_error'] = 'Invalid email or password';
        header('Location: ../views/admin-login.php');
        exit();
    }
}
?>
