<?php
session_start();
header('Content-Type: application/json');

// SHOW ERRORS FOR DEBUGGING (REMOVE IN PRODUCTION)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../model/body.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$email = $_SESSION['email'];
$weight = floatval($_POST['weight'] ?? 0);
$waist = floatval($_POST['waist'] ?? 0);
$chest = floatval($_POST['chest'] ?? 0);

// VALIDATION
if ($weight <= 0 || $waist <= 0 || $chest <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid input values.']);
    exit;
}

// TRY TO SAVE
if (saveBodyMeasurement($email, $weight, $waist, $chest)) {
    echo json_encode(['success' => true, 'message' => 'Measurement saved successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save measurement. Check server logs.']);
}
