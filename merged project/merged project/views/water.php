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
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Water Intake Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css">
  
</head>
<body>

<header>
  <h1>Water Intake Tracker</h1>
</header>

<div class="container">

  <!-- Hydration Tracker -->
  <section>
    <h2>Hydration Tracker</h2>
    <form id="hydrationForm">
      <label for="amount">Amount (ml):</label>
      <input type="number" id="amount" name="amount" placeholder="e.g. 250" required />
      <div id="amountError" class="error"></div>

      <button type="submit">Log Water</button>
    </form>
  </section>

  <!-- Reminder Setup -->
  <section>
    <h2>Reminder Setup</h2>
    <form id="reminderForm">
      <label for="goal">Daily Goal (ml):</label>
      <input type="number" id="goal" name="goal" placeholder="e.g. 2000" required />
      <div id="goalError" class="error"></div>

      <label for="reminderTime">Reminder Interval (hours):</label>
      <select id="reminderTime" name="reminderTime" required>
        <option value="">Select interval</option>
        <option value="1">Every 1 hour</option>
        <option value="2">Every 2 hours</option>
        <option value="3">Every 3 hours</option>
      </select>
      <div id="reminderError" class="error"></div>

      <button type="submit">Save Reminder</button>
    </form>
  </section>

  <!-- History View -->
  <section>
    <h2>History View</h2>
    <p>💧 250ml - 10:00 AM</p>
    <p>💧 300ml - 12:30 PM</p>
    <p>💧 200ml - 2:15 PM</p>
    <!-- In a full app, this would be dynamically loaded -->
  </section>

</div>

<script src ="../assets/scripts/water.js"></script>

</body>
</html>
