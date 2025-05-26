<?php

function dbConnect() {
    $conn = mysqli_connect('localhost', 'root', '', 'fitnesstracker', 3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function saveContactMessage($name, $email, $message) {
    $conn = dbConnect();
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
