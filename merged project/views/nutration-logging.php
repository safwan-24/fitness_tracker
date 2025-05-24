<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Simple Nutrition Logger</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />

  <style>
    body { font-family: Arial; padding: 20px; }
    input, button { margin: 5px 0; padding: 8px; width: 100%; }
    .log-entry { border-bottom: 1px solid #ccc; padding: 10px 0; }
  </style>
</head>
<body>

<h2>Simple Nutrition Logger</h2>

<form id="nutritionForm">
  <input type="text" id="foodName" placeholder="Food Name (e.g., Apple)" required>
  <input type="number" id="foodCalories" placeholder="Calories" required>
  <input type="number" id="foodProtein" placeholder="Protein (g)">
  <input type="number" id="foodCarbs" placeholder="Carbs (g)">
  <input type="number" id="foodFat" placeholder="Fat (g)">
  <button type="button" onclick="addFood()">Add Food</button>
</form>

<h3>Today's Food Log:</h3>
<div id="foodLog"></div>

<script>
   src="../assets/scripts/nutration-logging.js">
</script>

</body>
</html>
