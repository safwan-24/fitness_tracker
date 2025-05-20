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
  <title>Fitness Tracker - Home</title>
  <link rel="stylesheet" href="../assets/styles/dashboard.css" />
 
</head>
<body>

<nav>
  <div><strong>Fitness Tracker</strong></div>
  <div>
    <span id="username">Welcome, user</span>
     <button class="nav-button" onclick="location.href='profile.php'" style="background: #2d89ef;">Profile</button>
    <button class="nav-button" onclick="location.href='logout.php'" style="background: #d9534f;">Logout</button>
   <?php
        if (isset($_GET['error'])) {
          echo "<p style='color:red;'>Invalid username or password</p>";
        }
        ?>
  </div>
</nav>

<div class="container">
  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/workoutLogger.jpg')">
    <h2>Workout Logger</h2>
    <p>Log your sets, reps, and workout duration.</p>
    <a href="./workoutlog.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/progress.jpg')">
    <h2>Exercise Library</h2>
    <p>Browse exercises with animations and filters.</p>
    <a href="./exercise.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/chart.jpg')">
    <h2>Progress Charts</h2>
    <p>See visual graphs of your fitness journey.</p>
    <a href="./progess.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/water.jpg')">
    <h2>Water Tracker</h2>
    <p>Tap to log each glass and meet your goal.</p>
    <a href="./water.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/measure.jpg')">
    <h2>Body Measurements</h2>
    <p>Track body metrics and view visual progress.</p>
    <a href="./body.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/goal.jpg')">
    <h2>Goal Setting</h2>
    <p>Set SMART goals and earn achievements.</p>
    <a href="./goalSettings.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/plan.jpg')">
    <h2>Workout Planner</h2>
    <p>Plan your weekly routine using drag-and-drop.</p>
    <a href="./workout-plans.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/challenge.jpg')">
    <h2>Friend Challenges</h2>
    <p>Compete with friends and cheer each other on!</p>
    <a href="./friend-challenge.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/nutrition.jpg')">
    <h2>Nutrition Logger</h2>
    <p>Log meals, scan barcodes, and track macros.</p>
    <a href="./nutration-logging.php">Open</a>
  </div>

  <!-- New Device Sync Section -->
  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/device.jpg')">
    <h2>Device Sync</h2>
    <p>Connect your fitness devices and sync data.</p>
    <a href="./device-sync.php">Open</a>
  </div>
      <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/device.jpg')">
    <h2>Contact US</h2>
    <p>Connect your information.</p>
    <a href="./contact.php">Open</a>
  </div>

   <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/device.jpg')">
    <h2>Data Export</h2>
    <p>Connect your information.</p>
    <a href="Dataexport.php">Open</a>
  </div>

  <div class="section" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/imgs/device.jpg')">
    <h2>Activity Logs</h2>
    <p>Connect your activity.</p>
    <a href="activity.php">Open</a>
  </div>
</div>
</body>
</html>