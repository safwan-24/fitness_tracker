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
  <style>
    .workout-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .workout-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .workout-header h1 {
      color: #fff;
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
    
    .workout-header p {
      color: #aaa;
      font-size: 1.1rem;
    }
    
    /* Program Selection */
    .program-options {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }
    
    .program-btn {
      padding: 12px 25px;
      background: rgba(45, 137, 239, 0.2);
      color: #2d89ef;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .program-btn:hover {
      background: rgba(45, 137, 239, 0.3);
    }
    
    .program-btn.active {
      background: #2d89ef;
      color: white;
    }
    
    /* Workout Builder */
    .workout-builder {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 25px;
    }
    
    @media (max-width: 900px) {
      .workout-builder {
        grid-template-columns: 1fr;
      }
    }
    
    /* Exercise Library */
    .exercise-library {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }
    
    .exercise-search {
      margin-bottom: 20px;
    }
    
    .exercise-search input {
      width: 100%;
      padding: 12px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 6px;
      color: #fff;
      font-size: 1rem;
    }
    
    .exercise-categories {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
      flex-wrap: wrap;
    }
    
    .category-btn {
      padding: 8px 15px;
      background: rgba(255, 255, 255, 0.05);
      color: #aaa;
      border: none;
      border-radius: 20px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .category-btn:hover {
      background: rgba(255, 255, 255, 0.1);
    }
    
    .category-btn.active {
      background: #2d89ef;
      color: white;
    }
    
    .exercise-list {
      max-height: 500px;
      overflow-y: auto;
    }
    
    .exercise-item {
      background: rgba(255, 255, 255, 0.05);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      cursor: grab;
      transition: all 0.3s ease;
    }
    
    .exercise-item:hover {
      background: rgba(255, 255, 255, 0.1);
    }
    
    .exercise-name {
      font-weight: bold;
      color: #fff;
      margin-bottom: 5px;
    }
    
    .exercise-muscles {
      color: #aaa;
      font-size: 0.9rem;
    }
    
    /* Workout Plan */
    .workout-plan {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }
    
    .week-tabs {
      display: flex;
      margin-bottom: 20px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 6px;
      overflow: hidden;
    }
    
    .week-tab {
      flex: 1;
      text-align: center;
      padding: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .week-tab.active {
      background: rgba(45, 137, 239, 0.3);
      color: #2d89ef;
      font-weight: bold;
    }
    
    .week-tab:not(.active):hover {
      background: rgba(255, 255, 255, 0.1);
    }
    
    .day-container {
      min-height: 300px;
      padding: 15px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      margin-bottom: 15px;
    }
    
    .day-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .day-title {
      font-size: 1.2rem;
      color: #fff;
      font-weight: bold;
    }
    
    .exercise-dropzone {
      min-height: 100px;
      padding: 15px;
      background: rgba(255, 255, 255, 0.03);
      border: 2px dashed rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .exercise-dropzone.highlight {
      border-color: #2d89ef;
      background: rgba(45, 137, 239, 0.1);
    }
    
    .planned-exercise {
      background: rgba(45, 137, 239, 0.2);
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .exercise-actions {
      display: flex;
      gap: 10px;
    }
    
    .exercise-actions button {
      background: none;
      border: none;
      color: #aaa;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .exercise-actions button:hover {
      color: #fff;
    }
    
    /* Save Button */
    .save-plan {
      text-align: center;
      margin-top: 30px;
    }
    
    .save-btn {
      padding: 12px 30px;
      background: #2d89ef;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .save-btn:hover {
      background: #236ac3;
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
    // Display username
    const user = localStorage.getItem("user");
    if (user) {
      document.getElementById("username").textContent = `Welcome, ${user}`;
    }
    
    // Program selection
    function selectProgram(level) {
      document.querySelectorAll('.program-btn').forEach(btn => {
        btn.classList.remove('active');
      });
      event.target.classList.add('active');
      
      // In a real app, this would load different workout templates
      console.log(`Selected ${level} program`);
    }
    
    // Drag and drop functionality
    document.addEventListener('DOMContentLoaded', () => {
      const exerciseItems = document.querySelectorAll('.exercise-item');
      const dropzones = document.querySelectorAll('.exercise-dropzone');
      
      // Make exercises draggable
      exerciseItems.forEach(item => {
        item.addEventListener('dragstart', dragStart);
      });
      
      // Set up drop zones
      dropzones.forEach(zone => {
        zone.addEventListener('dragover', dragOver);
        zone.addEventListener('dragleave', dragLeave);
        zone.addEventListener('drop', drop);
      });
    });
    
    let draggedItem = null;
    
    function dragStart() {
      draggedItem = this;
      setTimeout(() => {
        this.style.opacity = '0.4';
      }, 0);
    }
    
    function dragOver(e) {
      e.preventDefault();
      this.classList.add('highlight');
    }
    
    function dragLeave() {
      this.classList.remove('highlight');
    }
    
    function drop(e) {
      e.preventDefault();
      this.classList.remove('highlight');
      
      if (draggedItem) {
        const clonedItem = draggedItem.cloneNode(true);
        clonedItem.style.opacity = '1';
        clonedItem.draggable = false;
        
        // Add exercise controls
        const exerciseControls = document.createElement('div');
        exerciseControls.className = 'exercise-actions';
        exerciseControls.innerHTML = `
          <button onclick="removeExercise(this)">✕</button>
          <button onclick="editExercise(this)">✏️</button>
        `;
        
        clonedItem.appendChild(exerciseControls);
        this.appendChild(clonedItem);
      }
    }
    
    // Exercise actions
    function removeExercise(button) {
      button.closest('.exercise-item').remove();
    }
    
    function editExercise(button) {
      const exercise = button.closest('.exercise-item');
      const exerciseName = exercise.querySelector('.exercise-name').textContent;
      const newName = prompt("Edit exercise name:", exerciseName);
      
      if (newName) {
        exercise.querySelector('.exercise-name').textContent = newName;
      }
    }
    
    // Week tab switching
    document.querySelectorAll('.week-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        document.querySelectorAll('.week-tab').forEach(t => {
          t.classList.remove('active');
        });
        this.classList.add('active');
        // In a real app, this would load the selected week's plan
      });
    });
    
    // Category filtering
    document.querySelectorAll('.category-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.category-btn').forEach(b => {
          b.classList.remove('active');
        });
        this.classList.add('active');
        // In a real app, this would filter exercises by category
      });
    });
    
    function logout() {
      localStorage.removeItem("user");
      window.location.href = "login.html";
    }
  </script>
</body>
</html>