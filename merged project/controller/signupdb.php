<?php
require_once '../model/signup.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Please fill in all fields.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    if (userExists($email)) {
        die("User already exists with this email.");
    }

    if (registerUser($username, $email, $password)) {
        header('Location: ../views/login.php');
        exit;
    } else {
        echo "Error while registering user.";
    }
} else {
    header('Location: ../views/signup.php');
    exit;
}
