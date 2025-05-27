<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-dashboard.php');
    exit();
}

// Get and clear any error message
$error_message = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css">
  <style>
    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <table class="main-table">
    <tr>
      <td colspan="2" class="logo-cell">
        <div class="logo-text">Fitness Tracker</div>
      </td>
    </tr>
    <tr>
      <td colspan="2" class="form-cell">
        <h2>Admin Login</h2>
        <?php if (!empty($error_message)): ?>
          <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form action="../controller/admin-auth.php" method="POST">
          <table>
            <tr>
              <td>Admin Email:</td>
              <td><input type="email" name="email" required></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td><input type="password" name="password" required></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">
                <button type="submit">Login</button>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="form-links">
                <a href="forgotpassword.html">Forgot password?</a><br>
                <a href="login.php">User Login</a>
              </td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>

</body>
</html>
