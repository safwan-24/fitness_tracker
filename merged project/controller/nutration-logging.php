<?php
session_start();
require_once __DIR__ . '/../model/nutrition_logging.php';

function validate($data) {
    if (empty(trim($data['foodName']))) {
        return "Food name is required.";
    }
    if (!isset($data['foodCalories']) || $data['foodCalories'] <= 0) {
        return "Calories must be a positive number.";
    }
    if ($data['foodProtein'] < 0 || $data['foodCarbs'] < 0 || $data['foodFat'] < 0) {
        return "Protein, Carbs, and Fat cannot be negative.";
    }
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodName = trim($_POST['foodName'] ?? '');
    $foodCalories = (int)($_POST['foodCalories'] ?? 0);
    $foodProtein = (float)($_POST['foodProtein'] ?? 0);
    $foodCarbs = (float)($_POST['foodCarbs'] ?? 0);
    $foodFat = (float)($_POST['foodFat'] ?? 0);

    $error = validate([
        'foodName' => $foodName,
        'foodCalories' => $foodCalories,
        'foodProtein' => $foodProtein,
        'foodCarbs' => $foodCarbs,
        'foodFat' => $foodFat,
    ]);

    if ($error) {
        header("Location: ../view/nutrition_logging.php?message=" . urlencode($error));
        exit;
    }

    FoodLogModel::addFood([
        'name' => $foodName,
        'calories' => $foodCalories,
        'protein' => $foodProtein,
        'carbs' => $foodCarbs,
        'fat' => $foodFat,
    ]);

    header("Location: ../view/nutrition_logging.php?message=" . urlencode("Food added successfully!"));
    exit;
}
?>
