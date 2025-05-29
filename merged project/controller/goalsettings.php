<?php
require_once "../model/goalsettings.php";

header('Content-Type: application/json'); 

$input = json_decode(file_get_contents('php://input'), true);

if ($input) {
    $title = trim($input['title'] ?? '');
    $type = trim($input['type'] ?? '');
    $targetValue = (int)($input['targetValue'] ?? 0);
    $unit = trim($input['unit'] ?? '');
    $targetDate = $input['targetDate'] ?? '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $targetValue = (int)($_POST['targetValue'] ?? 0);
    $unit = trim($_POST['unit'] ?? '');
    $targetDate = $_POST['targetDate'] ?? '';
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Bad request']);
    exit;
}

if (!$title || !$type || !$unit || !$targetDate || $targetValue <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data!']);
    exit;
}

try {
    GoalModel::addGoal([
        'title' => $title,
        'type' => $type,
        'targetValue' => $targetValue,
        'unit' => $unit,
        'targetDate' => $targetDate
    ]);
    echo json_encode(['success' => true, 'message' => 'Thank you !']);
} catch (Exception $e) {
    error_log("GoalModel::addGoal error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
