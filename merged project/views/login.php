<?php
session_start();
if (isset($_SESSION['email'])) {
  header('Location: dashboard.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
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
        <h2>Login</h2>
        <form action="../controller/auth.php" method="POST">
          <table class="form-table">
            <tr>
              <td>Email:</td>
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
                <a href="forgotpassword.html">Forgot password?</a><br />
                Don't have an account? <a href="signup.html">Sign up</a><br />
                <a href="admin-login.php">Admin Login?</a>
              </td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>
</body>
</html>
