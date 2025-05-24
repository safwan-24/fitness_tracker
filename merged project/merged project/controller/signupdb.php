<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database configuration
    $host = "localhost";
    $db = "fitnesstracker";
    $user = "root"; // Change if needed
    $pass = "";     // Change if needed

    // Connect to MySQL
    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate password confirmation
    if ($password !== $confirmPassword) {
        die("Error: Passwords do not match.");
    }

    // Prepare insert statement
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters (plain password)
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute
    if ($stmt->execute()) {
        echo "Sign up successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cleanup
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
