
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
  <link rel="stylesheet" href="style.css" />
  <style>
    .sync-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .sync-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .sync-header h1 {
      color: #fff;
      font-size: 2rem;
      margin-bottom: 10px;
    }
    
    .sync-header p {
      color: #aaa;
      font-size: 1rem;
    }
    
    .sync-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      margin-bottom: 25px;
    }
    
    .sync-card h2 {
      color: #2d89ef;
      margin-bottom: 20px;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }
    
    .sync-card h2 i {
      margin-right: 10px;
      font-size: 1.8rem;
    }
    
    .device-select {
      width: 100%;
      padding: 12px 15px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 6px;
      color: #fff;
      margin-bottom: 15px;
      font-size: 1rem;
    }
    
    .sync-btn {
      background: #2d89ef;
      color: white;
      border: none;
      padding: 12px 25px;
      border-radius: 6px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
      width: 100%;
      margin-top: 10px;
    }
    
    .sync-btn:hover {
      background: #236ac3;
    }
    
    .sync-btn:disabled {
      background: #555;
      cursor: not-allowed;
    }
    
    .device-list {
      margin-top: 20px;
    }
    
    .device-item {
      display: flex;
      align-items: center;
      padding: 15px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }
    
    .device-item:hover {
      background: rgba(45, 137, 239, 0.2);
    }
    
    .device-icon {
      width: 40px;
      height: 40px;
      background: rgba(45, 137, 239, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      font-size: 1.2rem;
    }
    
    .device-info {
      flex: 1;
    }
    
    .device-name {
      font-weight: bold;
      color: #fff;
      margin-bottom: 5px;
    }
    
    .device-type {
      color: #aaa;
      font-size: 0.9rem;
    }
    
    .sync-status {
      padding: 20px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      margin-top: 20px;
      min-height: 80px;
    }
    
    .sync-progress {
      height: 6px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 3px;
      margin-top: 15px;
      overflow: hidden;
    }
    
    .progress-bar {
      height: 100%;
      background: #2d89ef;
      width: 0%;
      transition: width 0.5s;
    }
    
    .priority-settings {
      margin-top: 20px;
    }
    
    .sync-success {
      color: #4CAF50;
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
    }
  </style>
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
    // Available devices (simulated)
    const availableDevices = [
      { id: "fitbit_123", name: "Fitbit Charge 5", type: "fitbit" },
      { id: "apple_456", name: "Apple Watch Series 8", type: "apple_watch" },
      { id: "garmin_789", name: "Garmin Venu 2", type: "garmin" }
    ];
    
    let connectedDevice = null;
    
    // Display username
    const user = localStorage.getItem("user");
    if (user) {
      document.getElementById("username").textContent = `Welcome, ${user}`;
    }
    
    // Scan for devices
    function scanDevices() {
      const deviceType = document.getElementById('deviceType').value;
      if (!deviceType) {
        alert("Please select a device type first");
        return;
      }
      
      const deviceList = document.getElementById('deviceList');
      deviceList.innerHTML = '<h3>Available Devices</h3>';
      deviceList.style.display = 'block';
      
      // Filter devices by type
      const filteredDevices = deviceType === 'other' 
        ? availableDevices 
        : availableDevices.filter(device => device.type === deviceType);
      
      if (filteredDevices.length === 0) {
        deviceList.innerHTML += '<p>No devices found. Make sure your device is nearby and Bluetooth is enabled.</p>';
        return;
      }
      
      // Add devices to list
      filteredDevices.forEach(device => {
        const deviceElement = document.createElement('div');
        deviceElement.className = 'device-item';
        deviceElement.onclick = () => connectDevice(device);
        deviceElement.innerHTML = `
          <div class="device-icon">${getDeviceIcon(device.type)}</div>
          <div class="device-info">
            <div class="device-name">${device.name}</div>
            <div class="device-type">${formatDeviceType(device.type)}</div>
          </div>
        `;
        deviceList.appendChild(deviceElement);
      });
    }
    
    // Connect device
    function connectDevice(device) {
      connectedDevice = device;
      const statusDiv = document.getElementById('syncStatus');
      statusDiv.innerHTML = `
        <p>Connected to: <strong>${device.name}</strong></p>
        <p>Status: <span style="color: #4CAF50;">Ready to sync</span></p>
      `;
      document.getElementById('syncBtn').disabled = false;
      document.getElementById('syncProgress').style.display = 'none';
      document.getElementById('syncSuccess').style.display = 'none';
    }
    
    // Start sync
    function startSync() {
      if (!connectedDevice) return;
      
      const statusDiv = document.getElementById('syncStatus');
      const syncBtn = document.getElementById('syncBtn');
      const progressDiv = document.getElementById('syncProgress');
      const progressBar = document.getElementById('progressBar');
      
      syncBtn.disabled = true;
      statusDiv.innerHTML = `
        <p>Syncing data from: <strong>${connectedDevice.name}</strong></p>
        <p>Status: <span style="color: #FFC107;">In progress...</span></p>
      `;
      progressDiv.style.display = 'block';
      progressBar.style.width = '0%';
      
      // Simulate sync progress
      let progress = 0;
      const interval = setInterval(() => {
        progress += 10;
        progressBar.style.width = `${progress}%`;
        
        if (progress >= 100) {
          clearInterval(interval);
          statusDiv.innerHTML = `
            <p>Sync complete with: <strong>${connectedDevice.name}</strong></p>
            <p>Status: <span style="color: #4CAF50;">Success</span></p>
          `;
          document.getElementById('syncSuccess').style.display = 'block';
          syncBtn.disabled = false;
        }
      }, 300);
    }
    
    // Save priority settings
    function savePriority() {
      const priority = document.getElementById('dataPriority').value;
      alert(`Sync priority set to: ${formatPriority(priority)}`);
    }
    
    // Helper functions
    function getDeviceIcon(type) {
      const icons = {
        fitbit: '⌚',
        apple_watch: '🍎',
        garmin: '🏃',
        other: '📱'
      };
      return icons[type] || '💻';
    }
    
    function formatDeviceType(type) {
      return type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
    }
    
    function formatPriority(priority) {
      const names = {
        steps: "Steps & Activity",
        heart_rate: "Heart Rate Data",
        workouts: "Workout Details",
        all: "Everything"
      };
      return names[priority] || priority;
    }
    
    function logout() {
      localStorage.removeItem("user");
      window.location.href = "login.html";
    }
  </script>
</body>
</html>