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
 
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 40px;
    }
    .export-form {
      max-width: 400px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .export-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .export-form label {
      display: block;
      margin: 10px 0 5px;
    }
    .export-form input,
    .export-form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .checkbox-container {
      display: flex;
      align-items: center;
    }
    .checkbox-container input {
      margin-right: 10px;
    }
    .export-form button {
      background: #007bff;
      color: white;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    .export-form button:hover {
      background: #0056b3;
    }
  </style>
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
  const form = document.getElementById('exportForm');
  const scheduleCheckbox = document.getElementById('schedule');
  const scheduleTimeContainer = document.getElementById('scheduleTimeContainer');

  scheduleCheckbox.addEventListener('change', () => {
    scheduleTimeContainer.style.display = scheduleCheckbox.checked ? 'block' : 'none';
  });

  form.addEventListener('submit', function (e) {
    const startDate = new Date(document.getElementById('startDate').value);
    const endDate = new Date(document.getElementById('endDate').value);

    if (startDate > endDate) {
      alert("Start date cannot be after end date.");
      e.preventDefault();
      return;
    }

    if (scheduleCheckbox.checked) {
      const timeValue = document.getElementById('scheduleTime').value;
      if (!timeValue) {
        alert("Please specify a time for the scheduled export.");
        e.preventDefault();
        return;
      }
    }

    alert("Export initiated!");
    // Replace with actual export logic or server submission
  });
</script>

</body>
</html>