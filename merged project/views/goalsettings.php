<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Goal Settings | Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
    <link rel="stylesheet" href="../assets/styles/goalsettings.css" />

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

  <script src="../assets/scripts/goalsettings.js"> </script>
</body>
</html>