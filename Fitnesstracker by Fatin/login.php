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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
      width: 300px;
    }
    .login-box h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .login-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
    }
    .login-box button {
      width: 100%;
      padding: 10px;
      background: #2d89ef;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Login</h2>
  <form action="auth.php" method="POST">
    <input type="email" id="email" name="email" placeholder="Email" />
    <input type="password" id="password" name="password" placeholder="Password" />
    <button onclick="login()">Login</button>
  </form>
</div>

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
