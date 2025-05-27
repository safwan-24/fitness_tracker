<?php
session_start();
include_once '../model/goalsettings-model.php'; // your model
include_once '../dbconnection.php'; // your DB connection

// Get POST data
$title       = trim($_POST['title'] ?? '');
$type        = trim($_POST['type'] ?? '');
$targetValue = trim($_POST['targetValue'] ?? '');
$unit        = trim($_POST['unit'] ?? '');
$targetDate  = trim($_POST['targetDate'] ?? '');
$email       = $_SESSION['email'] ?? '';

// Validate inputs
if (empty($title) || empty($type) || empty($targetValue) || empty($unit) || empty($targetDate) || empty($email)) {
    $response = ['success' => false, 'message' => 'All fields are required.'];
    sendJsonResponse($response);
}

// Save to database using model
$goalModel = new GoalModel($conn);
$success = $goalModel->createGoal($email, $title, $type, $targetValue, $unit, $targetDate);

if ($success) {
    $response = ['success' => true, 'message' => 'Goal created successfully.'];
} else {
    $response = ['success' => false, 'message' => 'Failed to create goal.'];
}

sendJsonResponse($response);

// Utility function to return JSON only for AJAX
function sendJsonResponse($data) {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    // fallback for non-AJAX requests (debugging)
    die($data['message'] ?? 'Unknown error');
}
