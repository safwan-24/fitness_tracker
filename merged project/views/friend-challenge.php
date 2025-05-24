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
  <link rel="stylesheet" href="../assets/styles/friend-challenge.css" />
  
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

  
     <script src="../assets/scripts/friend-challenge.js"></script>
</body>
</html>