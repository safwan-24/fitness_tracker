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
  <meta charset="UTF-8" />
  <title>Activity Logs</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
  <div class="log-container">
    <h1>Activity Logs</h1>

    <form id="filterForm" class="log-form">
      <div class="form-row">
        <label for="logDate">Date:</label>
        <input type="date" id="logDate" name="logDate" />
      </div>
      <div class="form-row">
        <label for="logUser">User:</label>
        <input type="text" id="logUser" name="logUser" placeholder="Enter username" />
      </div>
      <div class="form-row">
        <label for="logAction">Action Type:</label>
        <input type="text" id="logAction" name="logAction" placeholder="Login, Update, Delete..." />
      </div>

      <div class="form-buttons">
        <button type="button" onclick="filterLogs()">Apply Filters</button>
        <button type="button" onclick="exportLogs()">Export Logs</button>
      </div>
    </form>

    <table id="logTable">
      <thead>
        <tr>
          <th>Date</th>
          <th>User</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="logResults">
      </tbody>
    </table>
  </div>

  <script src="../assets/scripts/activity.js"></script>
</body>
</html>
