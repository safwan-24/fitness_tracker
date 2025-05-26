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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Workout Logger</title>
  <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>
  <div class="container">
    <h1>Workout Logger</h1>

    <div class="timer">
      <p id="timer">00:00:00</p>
      <button onclick="startStopTimer()">Start/Stop Timer</button>
    </div>

    <form id="workoutForm" autocomplete="off">
      <h2>Log Workout</h2>
      <input type="text" placeholder="Exercise Name" id="exercise" required />
      <input type="number" placeholder="Sets" id="sets" required />
      <input type="number" placeholder="Reps" id="reps" required />
      <input type="number" placeholder="Weight (kg)" id="weight" required />
      <textarea placeholder="Notes..." id="notes"></textarea>
      <button type="submit">Save Session</button>
    </form>

 
  </div>

  <script src="../assets/scripts/workoutlog.js"></script>
</body>
</html>
