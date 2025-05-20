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
  <title>Body Measurements</title>
  <link rel="stylesheet" href="../assets/styles/style.css">
  
</head>
<body>
  <div class="container">
    <h1>Body Measurements</h1>
    <form id="measureForm">
      <label>Weight (kg): <input type="number" id="weight" required></label><br><br>
      <label>Waist (cm): <input type="number" id="waist" required></label><br><br>
      <label>Chest (cm): <input type="number" id="chest" required></label><br><br>
      <button type="submit">Save</button>
    </form>
  </div>

  <script src="../assets/scripts/body.js"></script>
</body>
</html>
