<?php
include '../model/profile.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Management</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>
<div class="container">
    <h1>Profile Management</h1>

    <?php if (!empty($success)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php elseif (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- View Profile -->
    <div class="view-profile">
        <h2>View Profile</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name'] ?? '') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
    </div>

    <!-- Edit Profile -->
    <form method="post" action="../controller/profile.php">
        <input type="hidden" name="updateProfile" value="1">
        <label for="name">Name:</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($user['name'] ?? '') ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($user['email'] ?? '') ?>">
        <button type="submit">Save Changes</button>
    </form>

    <!-- Update Password -->
    <form method="post" action="../controller/profile.php">
        <input type="hidden" name="updatePassword" value="1">
        <label for="currentPassword">Current Password:</label>
        <input type="password" name="currentPassword" required>
        <label for="newPassword">New Password:</label>
        <input type="password" name="newPassword" required>
        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" name="confirmPassword" required>
        <button type="submit">Update Password</button>
    </form>
</div>
</body>
</html>
