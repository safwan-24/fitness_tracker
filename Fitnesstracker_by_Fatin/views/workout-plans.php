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
  <title>Workout Plans | Fitness Tracker</title>
  <link rel="stylesheet" href="style.css" />
  
</head>
<body>
  <nav>
    <div><strong>Fitness Tracker</strong></div>
    <div>
      <span id="username">Welcome, User</span>
      <button onclick="logout()" style="margin-left: 20px; background: red; border: none; padding: 5px 10px; border-radius: 4px; color: white; cursor: pointer;">Logout</button>
    </div>
  </nav>

  <div class="workout-container">
    <div class="workout-header">
      <h1>Workout Plans</h1>
      <p>Build your perfect workout routine</p>
    </div>
    
    <div class="program-options">
      <button class="program-btn active" onclick="selectProgram('beginner')">Beginner</button>
      <button class="program-btn" onclick="selectProgram('intermediate')">Intermediate</button>
      <button class="program-btn" onclick="selectProgram('advanced')">Advanced</button>
      <button class="program-btn" onclick="selectProgram('custom')">Custom</button>
    </div>
    
    <div class="workout-builder">
      <div class="exercise-library">
        <h2><i>📚</i> Exercise Library</h2>
        <div class="exercise-search">
          <input type="text" placeholder="Search exercises...">
        </div>
        <div class="exercise-categories">
          <button class="category-btn active">All</button>
          <button class="category-btn">Chest</button>
          <button class="category-btn">Back</button>
          <button class="category-btn">Legs</button>
          <button class="category-btn">Arms</button>
          <button class="category-btn">Shoulders</button>
          <button class="category-btn">Core</button>
          <button class="category-btn">Cardio</button>
        </div>
        <div class="exercise-list" id="exerciseList">
          <div class="exercise-item" draggable="true" data-exercise="push-up">
            <div class="exercise-name">Push Up</div>
            <div class="exercise-muscles">Chest, Triceps, Shoulders</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="squat">
            <div class="exercise-name">Squat</div>
            <div class="exercise-muscles">Quads, Hamstrings, Glutes</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="pull-up">
            <div class="exercise-name">Pull Up</div>
            <div class="exercise-muscles">Back, Biceps</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="deadlift">
            <div class="exercise-name">Deadlift</div>
            <div class="exercise-muscles">Back, Hamstrings, Glutes</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="bench-press">
            <div class="exercise-name">Bench Press</div>
            <div class="exercise-muscles">Chest, Triceps, Shoulders</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="shoulder-press">
            <div class="exercise-name">Shoulder Press</div>
            <div class="exercise-muscles">Shoulders, Triceps</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="bicep-curl">
            <div class="exercise-name">Bicep Curl</div>
            <div class="exercise-muscles">Biceps</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="tricep-dip">
            <div class="exercise-name">Tricep Dip</div>
            <div class="exercise-muscles">Triceps</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="lunges">
            <div class="exercise-name">Lunges</div>
            <div class="exercise-muscles">Quads, Hamstrings, Glutes</div>
          </div>
          <div class="exercise-item" draggable="true" data-exercise="plank">
            <div class="exercise-name">Plank</div>
            <div class="exercise-muscles">Core</div>
          </div>
        </div>
      </div>
      
      <div class="workout-plan">
        <h2><i>📅</i> My Workout Plan</h2>
        <div class="week-tabs">
          <div class="week-tab active">Week 1</div>
          <div class="week-tab">Week 2</div>
          <div class="week-tab">Week 3</div>
          <div class="week-tab">Week 4</div>
        </div>
        
        <div class="day-container">
          <div class="day-header">
            <div class="day-title">Monday</div>
          </div>
          <div class="exercise-dropzone" id="mondayDropzone">
            <!-- Exercises will be dropped here -->
          </div>
        </div>
        
        <div class="day-container">
          <div class="day-header">
            <div class="day-title">Wednesday</div>
          </div>
          <div class="exercise-dropzone" id="wednesdayDropzone">
            <!-- Exercises will be dropped here -->
          </div>
        </div>
        
        <div class="day-container">
          <div class="day-header">
            <div class="day-title">Friday</div>
          </div>
          <div class="exercise-dropzone" id="fridayDropzone">
            <!-- Exercises will be dropped here -->
          </div>
        </div>
        
        <div class="save-plan">
          <button class="save-btn">Save Workout Plan</button>
        </div>
      </div>
    </div>
  </div>

  <script>
      src="../assets/scripts/workout-plans.js">
  </script>
</body>
</html>