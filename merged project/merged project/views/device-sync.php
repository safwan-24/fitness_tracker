
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:   login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Device Sync | Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
  
</head>
<body>
  <nav>
    <div><strong>Fitness Tracker</strong></div>
    <div>
      <span id="username">Welcome, User</span>
      <button onclick="logout()" style="margin-left: 20px; background: red; border: none; padding: 5px 10px; border-radius: 4px; color: white; cursor: pointer;">Logout</button>
    </div>
  </nav>

  <div class="sync-container">
    <div class="sync-header">
      <h1>Device Sync</h1>
      <p>Connect your fitness devices and sync your workout data</p>
    </div>
    
    <div class="sync-card">
      <h2><i>🔍</i> Connect Device</h2>
      <select id="deviceType" class="device-select">
        <option value="">Select your device type</option>
        <option value="fitbit">Fitbit</option>
        <option value="apple_watch">Apple Watch</option>
        <option value="garmin">Garmin</option>
        <option value="other">Other Device</option>
      </select>
      
      <button id="scanBtn" class="sync-btn" onclick="scanDevices()">Scan for Devices</button>
      
      <div id="deviceList" class="device-list" style="display: none;">
        <h3>Available Devices</h3>
        <!-- Devices will be added here by JavaScript -->
      </div>
    </div>
    
    <div class="sync-card">
      <h2><i>🔄</i> Sync Status</h2>
      <div id="syncStatus" class="sync-status">
        <p>No device connected. Please scan and select a device first.</p>
      </div>
      
      <div id="syncProgress" class="sync-progress" style="display: none;">
        <div id="progressBar" class="progress-bar"></div>
      </div>
      
      <button id="syncBtn" class="sync-btn" onclick="startSync()" disabled>Sync Now</button>
      
      <div id="syncSuccess" class="sync-success" style="display: none;">
        Sync completed successfully!
      </div>
    </div>
    
    <div class="sync-card">
      <h2><i>⚙️</i> Sync Settings</h2>
      <div class="priority-settings">
        <label for="dataPriority">Data Sync Priority:</label>
        <select id="dataPriority" class="device-select">
          <option value="steps">Steps & Activity</option>
          <option value="heart_rate">Heart Rate Data</option>
          <option value="workouts">Workout Details</option>
          <option value="all">Sync Everything</option>
        </select>
        <button class="sync-btn" onclick="savePriority()">Save Settings</button>
      </div>
    </div>
  </div>

  <script>
     src="../assets/scripts/device-sync.js">
  </script>
</body>
</html>