<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Goal Settings</title>
      <link rel="stylesheet" href="../assets/styles/style.css" />

</head>
<body>
    <h1>Set a New Goal</h1>
    
    <?php if (isset($_GET['message'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    <form id="goalForm" method="POST" action="../controller/goalsettings.php">
        <input type="text" id="title" name="title" placeholder="Title" required />
        <input type="text" id="type" name="type" placeholder="Type" required />
        <input type="number" id="targetValue" name="targetValue" placeholder="Target Value" required />
        <input type="text" id="unit" name="unit" placeholder="Unit" required />
        <input type="date" id="targetDate" name="targetDate" required />
        <button type="submit">Create Goal</button>
    </form>
      <script src="../assets/scripts/goalsettings.js"></script>

</body>
</html>
