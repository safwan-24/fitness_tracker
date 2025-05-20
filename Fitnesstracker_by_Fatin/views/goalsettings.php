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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Goal Settings | Fitness Tracker</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .goals-container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .goals-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .goals-header h1 {
      color: #fff;
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
    
    .goals-header p {
      color: #aaa;
      font-size: 1.1rem;
    }
    
    .goals-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }
    
    .goal-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }
    
    .goal-card:hover {
      transform: translateY(-5px);
    }
    
    .goal-card h2 {
      color: #2d89ef;
      margin-bottom: 15px;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }
    
    .goal-card h2 i {
      margin-right: 10px;
      font-size: 1.8rem;
    }
    
    .goal-info {
      margin-bottom: 20px;
    }
    
    .goal-metric {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
    }
    
    .goal-metric span:first-child {
      color: #aaa;
    }
    
    .goal-metric span:last-child {
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
    
    .goal-actions {
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
    
    .btn-danger {
      background: rgba(255, 0, 0, 0.2);
      color: #ff6b6b;
    }
    
    .btn-danger:hover {
      background: rgba(255, 0, 0, 0.3);
    }
    
    /* Create Goal Modal */
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
    
    /* SMART Goals Info */
    .smart-info {
      background: rgba(45, 137, 239, 0.1);
      padding: 15px;
      border-radius: 8px;
      margin-top: 30px;
      border-left: 4px solid #2d89ef;
    }
    
    .smart-info h3 {
      color: #2d89ef;
      margin-top: 0;
    }
    
    .smart-info ul {
      padding-left: 20px;
      color: #aaa;
    }
    
    .smart-info li {
      margin-bottom: 8px;
    }
    
    /* Achievements Section */
    .achievements-section {
      margin-top: 40px;
    }
    
    .achievements-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 15px;
      margin-top: 20px;
    }
    
    .achievement {
      background: rgba(255, 255, 255, 0.05);
      padding: 15px;
      border-radius: 8px;
      text-align: center;
      transition: transform 0.3s ease;
    }
    
    .achievement:hover {
      transform: scale(1.05);
    }
    
    .achievement i {
      font-size: 2rem;
      margin-bottom: 10px;
      display: block;
    }
    
    .achievement.locked {
      opacity: 0.5;
      filter: grayscale(100%);
    }
    
    .achievement-name {
      font-weight: bold;
      color: #fff;
      margin-bottom: 5px;
    }
    
    .achievement-desc {
      color: #aaa;
      font-size: 0.8rem;
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

  <div class="goals-container">
    <div class="goals-header">
      <h1>Goal Settings</h1>
      <p>Set and track your fitness goals</p>
      <button class="btn btn-primary" onclick="openModal()">Create New Goal</button>
    </div>
    
    <div class="goals-grid">
      <!-- Active Goals -->
      <div class="goal-card">
        <h2><i>🏋️</i> Strength Training</h2>
        <div class="goal-info">
          <div class="goal-metric">
            <span>Target:</span>
            <span>3 sessions/week</span>
          </div>
          <div class="goal-metric">
            <span>Current:</span>
            <span>2 sessions</span>
          </div>
          <div class="goal-metric">
            <span>Timeframe:</span>
            <span>8 weeks</span>
          </div>
          <div class="progress-container">
            <div class="progress-bar" style="width: 67%"></div>
          </div>
          <div class="goal-metric">
            <span>Completed:</span>
            <span>4 of 6 weeks</span>
          </div>
        </div>
        <div class="goal-actions">
          <button class="btn btn-secondary">Edit</button>
          <button class="btn btn-primary">Log Progress</button>
        </div>
      </div>
      
      <div class="goal-card">
        <h2><i>🏃</i> Running Distance</h2>
        <div class="goal-info">
          <div class="goal-metric">
            <span>Target:</span>
            <span>50 miles/month</span>
          </div>
          <div class="goal-metric">
            <span>Current:</span>
            <span>32 miles</span>
          </div>
          <div class="goal-metric">
            <span>Timeframe:</span>
            <span>1 month</span>
          </div>
          <div class="progress-container">
            <div class="progress-bar" style="width: 64%"></div>
          </div>
          <div class="goal-metric">
            <span>Days Left:</span>
            <span>10 days</span>
          </div>
        </div>
        <div class="goal-actions">
          <button class="btn btn-secondary">Edit</button>
          <button class="btn btn-primary">Log Progress</button>
        </div>
      </div>
      
      <div class="goal-card">
        <h2><i>🍎</i> Nutrition</h2>
        <div class="goal-info">
          <div class="goal-metric">
            <span>Target:</span>
            <span>150g protein/day</span>
          </div>
          <div class="goal-metric">
            <span>Current Avg:</span>
            <span>120g</span>
          </div>
          <div class="goal-metric">
            <span>Timeframe:</span>
            <span>Ongoing</span>
          </div>
          <div class="progress-container">
            <div class="progress-bar" style="width: 80%"></div>
          </div>
          <div class="goal-metric">
            <span>Consistency:</span>
            <span>22/30 days</span>
          </div>
        </div>
        <div class="goal-actions">
          <button class="btn btn-secondary">Edit</button>
          <button class="btn btn-primary">Log Progress</button>
        </div>
      </div>
    </div>
    
    <div class="smart-info">
      <h3>SMART Goals Framework</h3>
      <p>Set effective goals using the SMART criteria:</p>
      <ul>
        <li><strong>Specific</strong> - Clearly define what you want to achieve</li>
        <li><strong>Measurable</strong> - Include quantifiable targets</li>
        <li><strong>Achievable</strong> - Set realistic but challenging goals</li>
        <li><strong>Relevant</strong> - Align with your overall fitness objectives</li>
        <li><strong>Time-bound</strong> - Set a clear deadline</li>
      </ul>
    </div>
    
    <div class="achievements-section">
      <h2><i>🏆</i> Goal Achievements</h2>
      <div class="achievements-grid">
        <div class="achievement">
          <i>🚀</i>
          <div class="achievement-name">First Goal</div>
          <div class="achievement-desc">Set your first goal</div>
        </div>
        <div class="achievement">
          <i>💯</i>
          <div class="achievement-name">Perfect Week</div>
          <div class="achievement-desc">Complete all weekly goals</div>
        </div>
        <div class="achievement locked">
          <i>🔥</i>
          <div class="achievement-name">Streak Master</div>
          <div class="achievement-desc">30-day goal streak</div>
        </div>
        <div class="achievement">
          <i>🏅</i>
          <div class="achievement-name">Goal Crusher</div>
          <div class="achievement-desc">Complete 5 goals</div>
        </div>
        <div class="achievement locked">
          <i>🌟</i>
          <div class="achievement-name">Legendary</div>
          <div class="achievement-desc">Complete 25 goals</div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Create Goal Modal -->
  <div class="modal" id="createGoalModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Create New Goal</h2>
        <button class="close-modal" onclick="closeModal()">×</button>
      </div>
      <form id="goalForm">
        <div class="form-group">
          <label for="goalName">Goal Name</label>
          <input type="text" id="goalName" class="form-control" placeholder="e.g., Run a 5K" required>
        </div>
        <div class="form-group">
          <label for="goalType">Goal Type</label>
          <select id="goalType" class="form-control" required>
            <option value="">Select a type</option>
            <option value="exercise">Exercise/Fitness</option>
            <option value="nutrition">Nutrition</option>
            <option value="weight">Weight Management</option>
            <option value="habit">Habit Formation</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="goalTarget">Target Value</label>
          <input type="text" id="goalTarget" class="form-control" placeholder="e.g., 3 times per week" required>
        </div>
        <div class="form-group">
          <label for="goalStart">Start Date</label>
          <input type="date" id="goalStart" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="goalEnd">End Date</label>
          <input type="date" id="goalEnd" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="goalNotes">Notes (Optional)</label>
          <textarea id="goalNotes" class="form-control" rows="3" placeholder="Add any details about your goal"></textarea>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Goal</button>
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
  </script>
</body>
</html>