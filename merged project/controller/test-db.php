<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../model/db.php');

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    echo "Database connection successful!<br>";
    
    // Check if goals table exists
    $result = $conn->query("SHOW TABLES LIKE 'goals'");
    
    if ($result->num_rows == 0) {
        // Create goals table
        $sql = "CREATE TABLE goals (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_email VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            goal_type VARCHAR(50) NOT NULL,
            target_value DECIMAL(10,2) NOT NULL,
            target_unit VARCHAR(50) NOT NULL,
            target_date DATE NOT NULL,
            progress DECIMAL(5,2) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            completed_at TIMESTAMP NULL,
            FOREIGN KEY (user_email) REFERENCES users(email) ON DELETE CASCADE
        )";
        
        if ($conn->query($sql)) {
            echo "Goals table created successfully!<br>";
        } else {
            echo "Error creating goals table: " . $conn->error . "<br>";
        }
    } else {
        echo "Goals table already exists!<br>";
    }
    
    // Test insert
    $test_data = [
        'user_email' => 'test@example.com',
        'title' => 'Test Goal',
        'goal_type' => 'fitness',
        'target_value' => 10.0,
        'target_unit' => 'km',
        'target_date' => '2024-12-31'
    ];
    
    $sql = "INSERT INTO goals (user_email, title, goal_type, target_value, target_unit, target_date) 
            VALUES (?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error . "<br>";
        exit;
    }
    
    $stmt->bind_param("sssdss", 
        $test_data['user_email'],
        $test_data['title'],
        $test_data['goal_type'],
        $test_data['target_value'],
        $test_data['target_unit'],
        $test_data['target_date']
    );
    
    if ($stmt->execute()) {
        echo "Test insert successful!<br>";
    } else {
        echo "Test insert failed: " . $stmt->error . "<br>";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
?> 