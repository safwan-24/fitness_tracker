// Display username
    const user = localStorage.getItem("user");
    if (user) {
      document.getElementById("username").textContent = `Welcome, ${user}`;
    }
    
    // Modal functions
    function openModal() {
      document.getElementById('createGoalModal').style.display = 'flex';
      // Set default dates
      const today = new Date().toISOString().split('T')[0];
      const nextMonth = new Date();
      nextMonth.setMonth(nextMonth.getMonth() + 1);
      const nextMonthStr = nextMonth.toISOString().split('T')[0];
      
      document.getElementById('goalStart').value = today;
      document.getElementById('goalEnd').value = nextMonthStr;
    }
    
    function closeModal() {
      document.getElementById('createGoalModal').style.display = 'none';
    }
    
    // Form submission
    document.getElementById('goalForm').onsubmit = function(e) {
      e.preventDefault();
      alert('Goal created successfully!');
      closeModal();
      // In a real app, you would add the new goal to the UI here
    };
    
    function logout() {
      localStorage.removeItem("user");
      window.location.href = "login.html";
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('createGoalModal');
      if (event.target === modal) {
        closeModal();
      }
    };