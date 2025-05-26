<?php
if (!function_exists('dbConnect')) {
    function dbConnect() {
        $conn = new mysqli("localhost", "root", "", "fitnesstracker");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function getUserByEmail($email) {
        $conn = dbConnect();
        $stmt = $conn->prepare("SELECT * FROM profile_management WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $user;
    }

    function updateProfile($name, $newEmail, $currentEmail) {
        $conn = dbConnect();
        $stmt = $conn->prepare("UPDATE profile_management SET name = ?, email = ? WHERE email = ?");
        $stmt->bind_param("sss", $name, $newEmail, $currentEmail);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    function updatePassword($email, $newPassword) {
        $conn = dbConnect();
        $stmt = $conn->prepare("UPDATE profile_management SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email); // plain text password
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
