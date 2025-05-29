<?php
require_once "../model/workout-plans.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $program = isset($_POST['program']) ? (int)$_POST['program'] : 0;
    $goal = trim($_POST['goal'] ?? '');
    $startDate = trim($_POST['startDate'] ?? '');

    if ($program <= 0 || !$goal || !$startDate) {
        header("Location: ../views/workout-plans.php?message=" . urlencode("Invalid input!"));
        exit;
    }

    $result = WorkoutPlan::add([
        'program' => $program,
        'goal' => $goal,
        'start_date' => $startDate
    ]);

    if ($result) {
        header("Location: ../views/workout-plans.php?message=" . urlencode("Workout plan saved successfully!"));
    } else {
        header("Location: ../views/workout-plans.php?message=" . urlencode("Failed to save workout plan."));
    }
    exit;
}
?>
