<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Workout Plan Form</title>
  <link rel="stylesheet" href="../assets/styles/workout-plans.css" />
    <link rel="stylesheet" href="../assets/styles/styles.css" />


 
</head>
<body>
  <div class="form-container">
    <h1>Select Your Workout Plan</h1>
    <form id="workoutForm" method="POST" action="../controller/workout-plans.php">


      <label for="program">Choose Program Duration:</label>
      <select id="program" name="program" required>
        <option value="">Select...</option>
        <option value="4">4 Weeks</option>
        <option value="6">6 Weeks</option>
        <option value="8">8 Weeks</option>
        <option value="12">12 Weeks</option>
      </select>

      <label for="goal">Workout Goal:</label>
      <select id="goal" name="goal" required>
        <option value="">Select...</option>
        <option value="strength">Build Strength</option>
        <option value="fat_loss">Fat Loss</option>
        <option value="flexibility">Increase Flexibility</option>
        <option value="endurance">Boost Endurance</option>
      </select>

      <label for="startDate">Start Date:</label>
      <input type="date" id="startDate" name="startDate" required />

      <button type="submit">Start Program</button>
    </form>

    <div id="confirmation" class="hidden">
      <h2>Program Scheduled!</h2>
      <p id="programDetails"></p>
    </div>
  </div>

  <script src="../assets/styles/workout-plans.js"></script>
</body>
</html>
