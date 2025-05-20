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
  <title>Friend Challenges | Fitness Tracker</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .challenges-container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .challenges-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .challenges-header h1 {
      color: #fff;
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
    
    .challenges-header p {
      color: #aaa;
      font-size: 1.1rem;
    }
    
    .challenges-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }
    
    .challenge-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }
    
    .challenge-card:hover {
      transform: translateY(-5px);
    }
    
    .challenge-card h2 {
      color: #2d89ef;
      margin-bottom: 15px;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }
    
    .challenge-card h2 i {
      margin-right: 10px;
      font-size: 1.8rem;
    }
    
    .challenge-info {
      margin-bottom: 20px;
    }
    
    .challenge-metric {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
    }
    
    .challenge-metric span:first-child {
      color: #aaa;
    }
    
    .challenge-metric span:last-child {
      color: #fff;
      font-weight: bold;
    }
    
    .progress-container {
      height: 8px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 4px;
      margin: 15px 0;
      overflow: hidden;
    }
    
    .progress-bar {
      height: 100%;
      background: #2d89ef;
      border-radius: 4px;
      transition: width 0.5s ease;
    }
    
    .participants {
      display: flex;
      margin-top: 20px;
    }
    
    .participant {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(45, 137, 239, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: -10px;
      border: 2px solid #111;
    }
    
    .participant.more {
      font-size: 0.8rem;
      background: rgba(255, 255, 255, 0.1);
    }
    
    .challenge-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    
    .btn {
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
    }
    
    .btn-primary {
      background: #2d89ef;
      color: white;
    }
    
    .btn-primary:hover {
      background: #236ac3;
    }
    
    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: white;
    }
    
    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.2);
    }
    
    /* Create Challenge Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }
    
    .modal-content {
      background: #111;
      padding: 30px;
      border-radius: 12px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .modal-header h2 {
      color: #fff;
      margin: 0;
    }
    
    .close-modal {
      background: none;
      border: none;
      color: #aaa;
      font-size: 1.5rem;
      cursor: pointer;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      color: #aaa;
      margin-bottom: 8px;
    }
    
    .form-control {
      width: 100%;
      padding: 12px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 6px;
      color: #fff;
      font-size: 1rem;
    }
    
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }
    
    /* Cheer Section */
    .cheer-section {
      margin-top: 40px;
    }
    
    .cheer-input {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    
    .cheer-input select,
    .cheer-input input {
      flex: 1;
      padding: 12px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 6px;
      color: #fff;
      font-size: 1rem;
    }
    
    .cheer-feed {
      max-height: 300px;
      overflow-y: auto;
      padding-right: 10px;
    }
    
    .cheer-item {
      background: rgba(255, 255, 255, 0.05);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    
    .cheer-header {
      display: flex;
      justify-content: space-between;
      color: #aaa;
      font-size: 0.9rem;
      margin-bottom: 5px;
    }
    
    .cheer-message {
      color: #fff;
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

  <div class="challenges-container">
    <div class="challenges-header">
      <h1>Friend Challenges</h1>
      <p>Compete with friends and stay motivated together!</p>
      <button class="btn btn-primary" onclick="openModal()">Create New Challenge</button>
    </div>
    
    <div class="challenges-grid">
      <!-- Active Challenges -->
      <div class="challenge-card">
        <h2><i>🏆</i> Step Challenge</h2>
        <div class="challenge-info">
          <div class="challenge-metric">
            <span>Goal:</span>
            <span>50,000 steps</span>
          </div>
          <div class="challenge-metric">
            <span>Time Left:</span>
            <span>5 days</span>
          </div>
          <div class="challenge-metric">
            <span>Your Progress:</span>
            <span>32,450 steps</span>
          </div>
          <div class="progress-container">
            <div class="progress-bar" style="width: 65%"></div>
          </div>
          <div class="challenge-metric">
            <span>Your Rank:</span>
            <span>#2 of 8</span>
          </div>
        </div>
        <div class="participants">
          <div class="participant">👤</div>
          <div class="participant">👤</div>
          <div class="participant">👤</div>
          <div class="participant more">+5</div>
        </div>
        <div class="challenge-actions">
          <button class="btn btn-secondary">View Details</button>
          <button class="btn btn-primary">Log Activity</button>
        </div>
      </div>
      
      <div class="challenge-card">
        <h2><i>💪</i> Workout Streak</h2>
        <div class="challenge-info">
          <div class="challenge-metric">
            <span>Goal:</span>
            <span>7 workouts/week</span>
          </div>
          <div class="challenge-metric">
            <span>Time Left:</span>
            <span>2 days</span>
          </div>
          <div class="challenge-metric">
            <span>Your Progress:</span>
            <span>5 workouts</span>
          </div>
          <div class="progress-container">
            <div class="progress-bar" style="width: 71%"></div>
          </div>
          <div class="challenge-metric">
            <span>Your Rank:</span>
            <span>#1 of 5</span>
          </div>
        </div>
        <div class="participants">
          <div class="participant">👤</div>
          <div class="participant">👤</div>
          <div class="participant">👤</div>
          <div class="participant more">+2</div>
        </div>
        <div class="challenge-actions">
          <button class="btn btn-secondary">View Details</button>
          <button class="btn btn-primary">Log Activity</button>
        </div>
      </div>
      
      <!-- More challenges would appear here -->
    </div>
    
    <div class="cheer-section">
      <h2><i>📣</i> Send Cheers</h2>
      <div class="cheer-input">
        <select id="friendSelect">
          <option value="">Select a friend</option>
          <option value="Alex">Alex</option>
          <option value="Taylor">Taylor</option>
          <option value="Jordan">Jordan</option>
        </select>
        <input type="text" id="cheerMessage" placeholder="Write a motivational message">
        <button class="btn btn-primary" onclick="sendCheer()">Send</button>
      </div>
      
      <h3>Recent Cheers</h3>
      <div class="cheer-feed" id="cheerFeed">
        <div class="cheer-item">
          <div class="cheer-header">
            <span>You → Alex</span>
            <span>10 min ago</span>
          </div>
          <div class="cheer-message">You're crushing it! Keep going!</div>
        </div>
        <div class="cheer-item">
          <div class="cheer-header">
            <span>Taylor → You</span>
            <span>25 min ago</span>
          </div>
          <div class="cheer-message">Almost there! Just 2,000 more steps to go!</div>
        </div>
        <div class="cheer-item">
          <div class="cheer-header">
            <span>Jordan → Everyone</span>
            <span>1 hour ago</span>
          </div>
          <div class="cheer-message">Let's finish this week strong team!</div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Create Challenge Modal -->
  <div class="modal" id="createChallengeModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Create New Challenge</h2>
        <button class="close-modal" onclick="closeModal()">×</button>
      </div>
      <form id="challengeForm">
        <div class="form-group">
          <label for="challengeName">Challenge Name</label>
          <input type="text" id="challengeName" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="challengeType">Challenge Type</label>
          <select id="challengeType" class="form-control" required>
            <option value="">Select a type</option>
            <option value="steps">Step Challenge</option>
            <option value="workouts">Workout Challenge</option>
            <option value="distance">Distance Challenge</option>
            <option value="calories">Calorie Burn Challenge</option>
          </select>
        </div>
        <div class="form-group">
          <label for="challengeGoal">Goal</label>
          <input type="number" id="challengeGoal" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="challengeDuration">Duration (days)</label>
          <input type="number" id="challengeDuration" class="form-control" min="1" value="7" required>
        </div>
        <div class="form-group">
          <label for="challengeFriends">Invite Friends</label>
          <select id="challengeFriends" class="form-control" multiple>
            <option value="Alex">Alex</option>
            <option value="Taylor">Taylor</option>
            <option value="Jordan">Jordan</option>
            <option value="Sam">Sam</option>
            <option value="Casey">Casey</option>
          </select>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Challenge</button>
        </div>
      </form>
    </div>
  </div>

  <script>
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
  </script>
</body>
</html>