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
    <meta charset="UTF-8">
    <title>Goal Settings</title>
</head>
<body>
    <h1>Set a New Goal</h1>
    <form id="goal-form">
        <label>Goal Title:</label>
        <input type="text" name="title" required><br>

        <label>Goal Type:</label>
        <select name="type" required>
            <option value="">Select Type</option>
            <option value="fitness">Fitness</option>
            <option value="health">Health</option>
            <option value="learning">Learning</option>
            <option value="career">Career</option>
            <option value="other">Other</option>
        </select><br>

        <label>Target Value:</label>
        <input type="number" name="targetValue" required><br>

        <label>Unit:</label>
        <select name="unit" required>
            <option value="">Select Unit</option>
            <option value="km">Kilometers</option>
            <option value="miles">Miles</option>
            <option value="lbs">Pounds</option>
            <option value="kg">Kilograms</option>
            <option value="days">Days</option>
            <option value="hours">Hours</option>
            <option value="items">Items</option>
        </select><br>

        <label>Target Date:</label>
        <input type="date" name="targetDate" required><br><br>

        <button type="submit">Create Goal</button>
    </form>

    <script src="../assets/scripts/goalsettings.js"></script>
</body>
</html>
