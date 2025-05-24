<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<<<<<<< HEAD
  <title>Workout Plan Form</title>
  <link rel="stylesheet" href="../assets/styles/workout-plans.css" />
=======
  <title>Workout Plans | Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
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
>>>>>>> 4aada892a4f8df7ffafebbe4f97b2c0b3561e32b
</head>
<body>
  <div class="form-container">
    <h1>Select Your Workout Plan</h1>
    <form id="workoutForm">
      <label for="program">Choose Program Duration:</label>
      <select id="program" name="program" required>
        <option value="">Select...</option>
        <option value="4">4 Weeks</option>
        <option value="6">6 Weeks</option>
        <option value="8">8 Weeks</option>
        <option value="12">12 Weeks</option>
      </select>

      <label for="goal">Workout Goal:</label>
      <select id="goal" name="goal" required>
        <option value="">Select...</option>
        <option value="strength">Build Strength</option>
        <option value="fat_loss">Fat Loss</option>
        <option value="flexibility">Increase Flexibility</option>
        <option value="endurance">Boost Endurance</option>
      </select>

      <label for="startDate">Start Date:</label>
      <input type="date" id="startDate" name="startDate" required />

      <button type="submit">Start Program</button>
    </form>

    <div id="confirmation" class="hidden">
      <h2>Program Scheduled!</h2>
      <p id="programDetails"></p>
    </div>
  </div>

  <script src="../assets/styles/workout-plans,js"></script>
</body>
</html>
