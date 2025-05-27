<?php
session_start();
require_once('../model/db.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create logs directory if it doesn't exist
$logDir = __DIR__ . '/../logs';
if (!file_exists($logDir)) {
    mkdir($logDir, 0777, true);
}

// Log function for debugging
function logDebug($message) {
    $logFile = __DIR__ . '/../logs/goals_debug.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// Log the session data
logDebug("Session data: " . print_r($_SESSION, true));

// Log function for debugging
function logError($message) {
    error_log(date('Y-m-d H:i:s') . " - " . $message . "\n", 3, "../logs/goal_errors.log");
}

// Log incoming request
$raw_data = file_get_contents('php://input');
logDebug("Received raw data: " . $raw_data);

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    logDebug("Error: User not authenticated");
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit;
}

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    logDebug("Error: Invalid request method - " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get POST data
$data = json_decode($raw_data, true);
logDebug("Decoded data: " . print_r($data, true));

if (json_last_error() !== JSON_ERROR_NONE) {
    logDebug("Error: JSON decode error - " . json_last_error_msg());
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data: ' . json_last_error_msg()]);
    exit;
}

// Validate required fields
$required_fields = ['title', 'type', 'targetValue', 'unit', 'targetDate'];
$errors = [];

foreach ($required_fields as $field) {
    if (!isset($data[$field]) || empty(trim($data[$field]))) {
        $errors[] = ucfirst($field) . ' is required';
    }
}

// Validate target value is numeric
if (isset($data['targetValue'])) {
    if (!is_numeric($data['targetValue'])) {
        $errors[] = 'Target value must be a number';
    } elseif ($data['targetValue'] <= 0) {
        $errors[] = 'Target value must be greater than 0';
    }
}

// Validate target date is in the future
if (isset($data['targetDate'])) {
    $target_date = new DateTime($data['targetDate']);
    $today = new DateTime();
    if ($target_date <= $today) {
        $errors[] = 'Target date must be in the future';
    }
}

// If there are validation errors, return them
if (!empty($errors)) {
    logDebug("Validation errors: " . print_r($errors, true));
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    if (!$conn) {
        throw new Exception("Database connection failed");
    }
    
    logDebug("Database connection established");
    
    // Prepare SQL statement
    $sql = "INSERT INTO goals (user_email, title, goal_type, target_value, target_unit, target_date, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
    
    logDebug("Preparing SQL: " . $sql);
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    // Log the values being bound
    $bindParams = [
        'email' => $_SESSION['email'],
        'title' => $data['title'],
        'type' => $data['type'],
        'value' => $data['targetValue'],
        'unit' => $data['unit'],
        'date' => $data['targetDate']
    ];
    logDebug("Binding parameters: " . print_r($bindParams, true));
    
    $stmt->bind_param(
        "sssdss",
        $_SESSION['email'],
        $data['title'],
        $data['type'],
        $data['targetValue'],
        $data['unit'],
        $data['targetDate']
    );
    
    logDebug("Executing statement...");
    if ($stmt->execute()) {
        $goal_id = $stmt->insert_id;
        logDebug("Goal created successfully with ID: " . $goal_id);
        
        // Verify the insert by selecting the data
        $verify_sql = "SELECT * FROM goals WHERE id = ?";
        $verify_stmt = $conn->prepare($verify_sql);
        $verify_stmt->bind_param("i", $goal_id);
        $verify_stmt->execute();
        $result = $verify_stmt->get_result();
        $inserted_goal = $result->fetch_assoc();
        logDebug("Verified inserted data: " . print_r($inserted_goal, true));
        
        echo json_encode([
            'success' => true,
            'message' => 'Goal created successfully',
            'goalId' => $goal_id,
            'goal' => $inserted_goal
        ]);
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
} catch (Exception $e) {
    logDebug("Error in goal-handler.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Error creating goal: ' . $e->getMessage()
    ]);
}
?> 