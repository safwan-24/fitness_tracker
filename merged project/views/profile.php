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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile Management</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>

  <div class="container">
    <h1>Profile Management</h1>

    <!-- View Profile -->
    <div class="view-profile">
      <h2>View Profile</h2>
      <img id="avatarView" src="avatar-placeholder.png" alt="Avatar" class="avatar" />
      <p><strong>Name:</strong> <span id="viewName">FATIN HASNAT</span></p>
      <p><strong>Email:</strong> <span id="viewEmail">fatin@example.com</span></p>
    </div>

    <!-- Edit Profile -->
    <form id="editProfileForm">
      <h2>Edit Profile</h2>
      <label for="name">Name:</label>
      <input type="text" id="name" />
      <small id="nameError" class="error"></small>

      <label for="email">Email:</label>
      <input type="email" id="email" />
      <small id="emailError" class="error"></small>

      <button type="submit">Save Changes</button>
    </form>

    <!-- Change Avatar -->
    <form id="avatarForm">
      <h2>Change Avatar</h2>
      <input type="file" id="avatar" accept="image/*" />
      <small id="avatarError" class="error"></small>
      <img id="avatarPreview" alt="Avatar Preview" style="display:none;" width="100" />
    </form>

    <!-- Update Password -->
    <form id="passwordForm">
      <h2>Update Password</h2>
      <label for="currentPassword">Current Password:</label>
      <input type="password" id="currentPassword" />

      <label for="newPassword">New Password:</label>
      <input type="password" id="newPassword" />

      <label for="confirmPassword">Confirm New Password:</label>
      <input type="password" id="confirmPassword" />
      <small id="passwordError" class="error"></small>

      <button type="submit">Update Password</button>
    </form>
  </div>

  <script src="../assets/scripts/script.js"></script>
</body>
</html>
