<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Us - Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/contact.css" />
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
        <!-- Contact Form -->
        <form id="contactForm" class="auth-form" method="POST" action="contact.php">
          <h2>Contact Us</h2>
          <table class="form-table">
            <tr>
              <td><label for="name">Name:</label></td>
              <td><input type="text" id="name" name="name" required /></td>
            </tr>
            <tr>
              <td><label for="email">Email:</label></td>
              <td><input type="email" id="email" name="email" required /></td>
            </tr>
            <tr>
              <td><label for="message">Message:</label></td>
              <td><textarea id="message" name="message" rows="4" required></textarea></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">
                <input type="checkbox" id="notRobot" required />
                <label for="notRobot">I'm not a robot</label>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">
                <button type="submit" name="submit">Submit</button>
              </td>
            </tr>
          </table>
        </form>

        <!-- Display result message -->
        <?php
          if (isset($_GET['msg'])) {
              echo "<p style='text-align:center; color: green;'>" . htmlspecialchars($_GET['msg']) . "</p>";
          }
        ?>
      </td>
    </tr>
  </table>
</body>
</html>

<?php
// Include handler at the end to process form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../controller/contact_submit.php';
}
?>
