<?php
session_start();
require_once('../model/db.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Prepare SQL statement to get goals for current user
    $sql = "SELECT * FROM goals WHERE user_email = ? ORDER BY created_at DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $goals = [];
    
    while ($row = $result->fetch_assoc()) {
        // Calculate progress (you might want to implement this based on your needs)
        $row['progress'] = 0; // Default progress
        $goals[] = $row;
    }
    
    echo json_encode($goals);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching goals: ' . $e->getMessage()
    ]);
}
?> 