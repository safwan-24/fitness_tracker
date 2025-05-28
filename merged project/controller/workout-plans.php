<?php
session_start();
require_once "../model/workout-plans.php"; // Include the model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $program = intval($_POST['program'] ?? 0);
    $goal = $_POST['goal'] ?? '';
    $startDate = $_POST['startDate'] ?? '';

    // Basic validation
    if ($program <= 0 || !$goal || !$startDate) {
        header("Location: ../views/workout-plans.php?error=" . urlencode("Invalid input"));
        exit;
    }

    // Store in DB via Model
    $success = WorkoutPlan::add([
        'program' => $program,
        'goal' => $goal,
        'start_date' => $startDate
    ]);

    if ($success) {
        header("Location: ../views/workout-plans.php?message=" . urlencode("Workout program scheduled!"));
    } else {
        header("Location: ../views/workout-plans.php?error=" . urlencode("Failed to save plan."));
    }
    exit;
}
