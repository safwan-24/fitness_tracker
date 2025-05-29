<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up - Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
  <form id="signupForm" class="auth-form" method="POST" action="../controller/signupdb.php">
    <table class="main-table">
      <tr>
        <td colspan="2" class="logo-cell">
          <div class="logo-text">Fitness Tracker</div>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="form-cell">
          <h2>Sign Up</h2>
          <table class="form-table">
            <tr>
              <td>Name:</td>
              <td><input type="text" name="name" required></td>
            </tr>
            <tr>
              <td>Email:</td>
              <td><input type="email" name="email" required></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td><input type="password" name="password" required></td>
            </tr>
            <tr>
              <td>Confirm Password:</td>
              <td><input type="password" name="confirmPassword" required></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">
                <button type="submit">Sign Up</button>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="form-links">
                Already have an account? <a href="login.html">Login</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
  <script src="form-validation.js"></script>
</body>
</html>
