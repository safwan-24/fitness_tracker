<?php
session_start();
include '../model/profile.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../views/login.php");
    exit;
}

$user = getUserByEmail($_SESSION['email']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateProfile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        if (updateProfile($name, $email, $_SESSION['email'])) {
            $_SESSION['email'] = $email;
            header("Location: ../views/profile.php?msg=Profile+Updated");
            exit;
        } else {
            $error = "Failed to update profile.";
        }
    }

    if (isset($_POST['updatePassword'])) {
        $current = $_POST['currentPassword'];
        $new = $_POST['newPassword'];
        $confirm = $_POST['confirmPassword'];

        // No hashing used, just direct match
        if ($current !== $user['password']) {
            $error = "Current password incorrect.";
        } elseif ($new !== $confirm) {
            $error = "New passwords do not match.";
        } else {
            if (updatePassword($user['email'], $new)) {
                $success = "Password updated successfully.";
            } else {
                $error = "Failed to update password.";
            }
        }
    }
}
?>
