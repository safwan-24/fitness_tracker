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