// Simulated Devices
const availableDevices = [
    { id: "fitbit_123", name: "Fitbit Charge 5", type: "fitbit" },
    { id: "apple_456", name: "Apple Watch Series 8", type: "apple_watch" },
    { id: "garmin_789", name: "Garmin Venu 2", type: "garmin" }
  ];
  
  let connectedDevice = null;
  
  // Scan for Devices
  function scanDevices() {
    const deviceList = document.getElementById('deviceList');
    deviceList.innerHTML = '';
  
    availableDevices.forEach(device => {
      const deviceElement = document.createElement('div');
      deviceElement.textContent = `${device.name} (${device.type.replace('_', ' ')})`;
      deviceElement.onclick = () => connectDevice(device);
      deviceList.appendChild(deviceElement);
    });
  }
  
  // Connect Device
  function connectDevice(device) {
    connectedDevice = device;
    const statusDiv = document.getElementById('syncStatus');
    statusDiv.innerHTML = `
      <p>Connected: <strong>${device.name}</strong></p>
      <p>Status: <span class="sync-active">Ready to sync</span></p>
    `;
    statusDiv.className = 'sync-status connected';
    document.getElementById('syncButton').disabled = false;
  }
  
  // Start Sync
  function startSync() {
    if (!connectedDevice) return;
  
    const statusDiv = document.getElementById('syncStatus');
    const syncButton = document.getElementById('syncButton');
    syncButton.disabled = true;
    statusDiv.innerHTML = `
      <p>Syncing <strong>${connectedDevice.name}</strong>...</p>
      <div class="progress-bar" id="syncProgress"></div>
    `;
  
    // Simulate sync progress
    let progress = 0;
    const progressBar = document.getElementById('syncProgress');
    const interval = setInterval(() => {
      progress += 10;
      progressBar.style.width = `${progress}%`;
      if (progress >= 100) {
        clearInterval(interval);
        statusDiv.innerHTML = `
          <p>Sync complete!</p>
          <p>Data from <strong>${connectedDevice.name}</strong> updated.</p>
        `;
        syncButton.disabled = false;
      }
    }, 300);
  }
  
  // Save Priority Settings
  function savePriority() {
    const priority = document.getElementById('dataPriority').value;
    alert(`Priority set to: ${priority.replace('_', ' ')}`);
  }