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
  <title>Progress Chart</title>
  <link rel="stylesheet" href="../assets/styles/progress.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <h1>Progress Chart</h1>
    <canvas id="progressChart"></canvas>
  </div>

  <script src="../assets/scripts/progress.js"></script>
</body>
</html>
