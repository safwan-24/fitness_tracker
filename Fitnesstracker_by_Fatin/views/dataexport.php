<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:   login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Export</title>
    <link rel="stylesheet" href="../assets/styles/style.css" />

</head>
<body>

<div class="export-form">
  <h2>Export Data</h2>
  <form id="exportForm">
    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required>

    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required>

    <label for="format">Export Format:</label>
    <select id="format" name="format" required>
      <option value="">Select format</option>
      <option value="pdf">PDF</option>
      <option value="csv">CSV</option>
    </select>

    <div class="checkbox-container">
      <input type="checkbox" id="schedule" name="schedule">
      <label for="schedule">Scheduled Export</label>
    </div>

    <div id="scheduleTimeContainer" style="display: none;">
      <label for="scheduleTime">Export Time (e.g., 02:00 AM):</label>
      <input type="time" id="scheduleTime" name="scheduleTime">
    </div>

    <button type="submit">Download</button>
  </form>
</div>

<script>
   src="../assets/scripts/dataexport.js">
</script>

</body>
</html>