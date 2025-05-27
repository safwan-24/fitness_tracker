<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../model/db.php');

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Check if users table exists
    $tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
    
    if ($tableCheck->num_rows == 0) {
        // Create users table if it doesn't exist
        $createTable = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($createTable)) {
            echo "Users table created successfully!<br>";
        } else {
            echo "Error creating users table: " . $conn->error . "<br>";
            exit;
        }
    }

    // Check if current user exists in the database
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            echo "User with email {$email} not found in database.<br>";
            echo "Please make sure you are properly registered in the system.<br>";
            echo "Current session data:<br>";
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
        } else {
            $user = $result->fetch_assoc();
            echo "User found in database:<br>";
            echo "Name: " . htmlspecialchars($user['name']) . "<br>";
            echo "Email: " . htmlspecialchars($user['email']) . "<br>";
            echo "Created at: " . $user['created_at'] . "<br>";
        }
    } else {
        echo "No user is currently logged in (no email in session).<br>";
        echo "Current session data:<br>";
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }
    
    // Show tables structure
    echo "<br>Database tables structure:<br>";
    $tables = ['users', 'goals'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW CREATE TABLE $table");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        } else {
            echo "Table $table not found<br>";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
?> 