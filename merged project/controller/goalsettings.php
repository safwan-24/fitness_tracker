<?php
require_once "../model/goalsettings.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $targetValue = (int)($_POST['targetValue'] ?? 0);
    $unit = trim($_POST['unit'] ?? '');
    $targetDate = $_POST['targetDate'] ?? '';

    if (!$title || !$type || !$unit || !$targetDate || $targetValue <= 0) {
        header("Location: ../views/goalsettings.php?message=" . urlencode("Invalid input data!"));
        exit;
    }

    GoalModel::addGoal([
        'title' => $title,
        'type' => $type,
        'targetValue' => $targetValue,
        'unit' => $unit,
        'targetDate' => $targetDate
    ]);

    header("Location: ../views/goalsettings.php?message=" . urlencode("Goal created successfully!"));
    exit;
}
?>
