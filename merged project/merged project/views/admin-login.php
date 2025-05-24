<?php
session_start();
if (isset($_SESSION['admin_email'])) {
  header('Location: admin-dashboard.php');
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
      
         <h2>Admin Login</h2>
          <form action="../controller/admin-auth.php" method="POST">
            <tr>
              <td>Admin Email:</td>
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
                <a href="login.php">User Login</a>
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
  function adminLogin() {
    const email = document.getElementById("admin-email").value;
    const password = document.getElementById("admin-password").value;

    if (email === "admin@gmail.com" && password === "admin1234") {
      localStorage.setItem("loggedInAdmin", email);
      /*window.location.href = "admin-dashboard.php";*/
    } else {
      alert("Invalid credentials!");
    }
  }
</script>

</body>
</html>