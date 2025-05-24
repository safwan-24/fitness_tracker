<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Goal Tracker Hidden Mode</title>
  
</head>
<body>

  <h1>Set Your SMART Goal</h1>

  <div class="card" id="goalFormCard">
    <input type="text" id="goalName" placeholder="Goal (e.g. Run 5K)" />
    <input type="number" id="target" placeholder="Target value" min="1" />
    <input type="number" id="current" placeholder="Starting progress" min="0" />
    <button onclick="setGoal()">Submit</button>
    <div class="error" id="errorBox"></div>
  </div>

  <input type="range" id="progressBar" oninput="checkProgress()" />

  <div id="trophy" class="hidden">🏆</div>

  
  <script src="../assets/scripts/goalsettings.js"></script>

</body>
</html>
