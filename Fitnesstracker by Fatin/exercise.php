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
  <title>Exercise Library</title>
  <link rel="stylesheet" href="exercise.css">
</head>
<body>
  <div class="container">
    <h1>Exercise Library</h1>
    <input type="text" id="search" placeholder="Search by name, equipment, or body part">
    <div id="exercise-list"></div>
  </div>

  <script src="exercise.js"></script>
</body>
</html>
