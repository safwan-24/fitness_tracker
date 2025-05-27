<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../model/db.php');

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // First, drop the foreign key constraint
    $dropFK = "ALTER TABLE goals DROP FOREIGN KEY goals_ibfk_1";
    if ($conn->query($dropFK)) {
        echo "Foreign key constraint dropped successfully<br>";
    } else {
        echo "Error dropping foreign key: " . $conn->error . "<br>";
    }
    
    // Modify users table email field
    $modifyUsers = "ALTER TABLE users MODIFY email varchar(255) NOT NULL";
    if ($conn->query($modifyUsers)) {
        echo "Users table email field modified successfully<br>";
    } else {
        echo "Error modifying users table: " . $conn->error . "<br>";
    }
    
    // Re-add the foreign key constraint
    $addFK = "ALTER TABLE goals 
              ADD CONSTRAINT goals_ibfk_1 
              FOREIGN KEY (user_email) 
              REFERENCES users(email) 
              ON DELETE CASCADE";
    
    if ($conn->query($addFK)) {
        echo "Foreign key constraint re-added successfully<br>";
    } else {
        echo "Error adding foreign key: " . $conn->error . "<br>";
    }
    
    // Verify the changes
    echo "<br>Updated table structures:<br>";
    
    $tables = ['users', 'goals'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW CREATE TABLE $table");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }
    
    // Verify existing data
    $email = 'safu2442@gmail.com';
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<br>User data verified:<br>";
        echo "Name: " . htmlspecialchars($user['name']) . "<br>";
        echo "Email: " . htmlspecialchars($user['email']) . "<br>";
        echo "Created at: " . $user['created_at'] . "<br>";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
?> 