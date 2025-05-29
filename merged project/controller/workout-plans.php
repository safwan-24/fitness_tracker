<?php
require_once "../model/goalsettings.php";

// Accept JSON input
$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $input) {
    $title = trim($input['title'] ?? '');
    $type = trim($input['type'] ?? '');
    $targetValue = (int)($input['targetValue'] ?? 0);
    $unit = trim($input['unit'] ?? '');
    $targetDate = $input['targetDate'] ?? '';

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
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Server error']);
    }
    exit;
}

// If accessed directly without POST + JSON, you can optionally redirect or show error
http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Bad request']);
exit;
?>
