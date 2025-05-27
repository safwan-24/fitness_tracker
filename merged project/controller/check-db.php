<?php
require_once('../model/db.php');

try {
    $db = new Database();
    $conn = $db->getConnection();

    // Check if goals table exists
    $tableCheck = $conn->query("SHOW TABLES LIKE 'goals'");
    
    if ($tableCheck->num_rows == 0) {
        // Create goals table
        $createTable = "CREATE TABLE IF NOT EXISTS goals (
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
        
        if ($conn->query($createTable)) {
            echo "Goals table created successfully!";
        } else {
            echo "Error creating goals table: " . $conn->error;
        }
    } else {
        echo "Goals table already exists!";
        
        // Show table structure
        $result = $conn->query("DESCRIBE goals");
        echo "\n\nTable structure:\n";
        while ($row = $result->fetch_assoc()) {
            echo print_r($row, true) . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 