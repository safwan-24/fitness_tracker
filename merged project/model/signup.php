<?php

function dbConnect() {
    $conn = mysqli_connect('localhost', 'root', '', 'fitnesstracker', 3306);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function userExists($email) {
    $conn = dbConnect();
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $exists = mysqli_num_rows($result) > 0;
    mysqli_close($conn);
    return $exists;
}

function registerUser($username, $email, $password) {
    $conn = dbConnect();
    $sql = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
