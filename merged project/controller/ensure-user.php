<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../model/db.php');

if (!isset($_SESSION['email'])) {
    die("No user is logged in");
}

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    $email = $_SESSION['email'];
    
    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        // User doesn't exist, create them
        $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'User_' . time();
        $password = password_hash('defaultpassword123', PASSWORD_DEFAULT); // You should change this in production
        
        $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $name, $email, $password);
        
        if ($insert->execute()) {
            echo json_encode([
                'success' => true,
                'message' => 'User created successfully',
                'email' => $email
            ]);
        } else {
            throw new Exception("Failed to create user");
        }
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'User already exists',
            'email' => $email
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?> 