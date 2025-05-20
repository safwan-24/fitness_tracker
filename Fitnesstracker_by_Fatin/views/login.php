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
   <table class="main-table">
    <tr>
      <td colspan="2" class="logo-cell">
      <div class="logo-text">Fitness Tracker</div>
        <link rel="stylesheet" href="../assets/styles/style.css" />
      </td>
    </tr>
    <tr>
      <td colspan="2" class="form-cell">
      
         <h2>Login</h2>
          <form action="../controller/auth.php" method="POST">
            <tr>
              <td>Email:</td>
              <td><input type="email" name="email"></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td><input type="password" name="password"></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">
                <button type="submit">Login</button>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="form-links">
                <a href="forgotpassword.html">Forgot password?</a><br />
                Don't have an account? <a href="signup.html">Sign up</a>
                <a href="admin-login.html">Admin-Login?</a><br />
              </td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>
</head>
<body>



<script>
  function login() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email === "user@gmail.com" && password === "user1234") {
      localStorage.setItem("loggedInUser", email);
      /*window.location.href = "home.html";*/
    } else {
      alert("Invalid credentials!");
    }
  }
</script>

</body>
</html>
