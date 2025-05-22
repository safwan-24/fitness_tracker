
    // Display username
    const user = localStorage.getItem("user");
    if (user) {
      document.getElementById("username").textContent = `Welcome, ${user}`;
    }
    
    // Modal functions
    function openModal() {
      document.getElementById('createChallengeModal').style.display = 'flex';
    }
    
    function closeModal() {
      document.getElementById('createChallengeModal').style.display = 'none';
    }
    
    // Form submission
    document.getElementById('challengeForm').onsubmit = function(e) {
      e.preventDefault();
      alert('Challenge created successfully!');
      closeModal();
      // In a real app, you would add the new challenge to the UI here
    };
    
    // Send cheer function
    function sendCheer() {
      const friend = document.getElementById('friendSelect').value;
      const message = document.getElementById('cheerMessage').value.trim();
      
      if (!friend || !message) {
        alert('Please select a friend and write a message');
        return;
      }
      
      const cheerFeed = document.getElementById('cheerFeed');
      const now = new Date();
      const timeString = formatTime(now);
      
      const cheerItem = document.createElement('div');
      cheerItem.className = 'cheer-item';
      cheerItem.innerHTML = `
        <div class="cheer-header">
          <span>You → ${friend}</span>
          <span>Just now</span>
        </div>
        <div class="cheer-message">${message}</div>
      `;
      
      cheerFeed.prepend(cheerItem);
      document.getElementById('cheerMessage').value = '';
    }
    
    // Helper function to format time
    function formatTime(date) {
      return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    
    function logout() {
      localStorage.removeItem("user");
      window.location.href = "login.html";
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('createChallengeModal');
      if (event.target === modal) {
        closeModal();
      }
    };