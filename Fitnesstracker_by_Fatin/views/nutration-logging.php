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
  <title>Nutrition Logger | Fitness Tracker</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .nutrition-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .nutrition-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .nutrition-header h1 {
      color: #fff;
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
    
    .nutrition-header p {
      color: #aaa;
      font-size: 1.1rem;
    }
    
    .nutrition-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
    }
    
    @media (max-width: 900px) {
      .nutrition-grid {
        grid-template-columns: 1fr;
      }
    }
    
    .nutrition-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }
    
    .nutrition-card h2 {
      color: #2d89ef;
      margin-bottom: 20px;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }
    
    .nutrition-card h2 i {
      margin-right: 10px;
      font-size: 1.8rem;
    }
    
    /* Quick Log Section */
    .quick-log-items {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 15px;
      margin-bottom: 20px;
    }
    
    .quick-log-item {
      background: rgba(45, 137, 239, 0.1);
      border-radius: 8px;
      padding: 15px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .quick-log-item:hover {
      background: rgba(45, 137, 239, 0.2);
      transform: translateY(-3px);
    }
    
    .quick-log-item i {
      font-size: 1.5rem;
      margin-bottom: 8px;
      display: block;
    }
    
    /* Manual Entry Form */
    .form-group {
      margin-bottom: 15px;
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
    
    .macro-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }
    
    /* Nutrition Dashboard */
    .dashboard {
      margin-bottom: 30px;
    }
    
    .macro-circles {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 15px;
      margin: 20px 0;
    }
    
    .macro-circle {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
      aspect-ratio: 1/1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border: 3px solid #2d89ef;
      position: relative;
    }
    
    .macro-circle::after {
      content: '';
      position: absolute;
      top: -3px;
      left: -3px;
      right: -3px;
      bottom: -3px;
      border-radius: 50%;
      border: 3px solid rgba(255, 255, 255, 0.1);
    }
    
    .macro-name {
      color: #aaa;
      font-size: 0.9rem;
      margin-bottom: 5px;
    }
    
    .macro-value {
      font-size: 1.5rem;
      font-weight: bold;
      color: #fff;
    }
    
    .macro-target {
      color: #aaa;
      font-size: 0.8rem;
      margin-top: 5px;
    }
    
    /* Food Log */
    .food-log {
      max-height: 400px;
      overflow-y: auto;
      padding-right: 10px;
    }
    
    .food-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      margin-bottom: 10px;
    }
    
    .food-info {
      flex: 1;
    }
    
    .food-name {
      font-weight: bold;
      color: #fff;
      margin-bottom: 5px;
    }
    
    .food-macros {
      color: #aaa;
      font-size: 0.9rem;
    }
    
    .food-calories {
      color: #2d89ef;
      font-weight: bold;
    }
    
    .food-delete {
      background: none;
      border: none;
      color: #ff6b6b;
      font-size: 1.2rem;
      cursor: pointer;
      margin-left: 15px;
    }
    
    /* Buttons */
    .btn {
      padding: 12px 25px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
      font-size: 1rem;
    }
    
    .btn-primary {
      background: #2d89ef;
      color: white;
      width: 100%;
    }
    
    .btn-primary:hover {
      background: #236ac3;
    }
    
    /* Meal Time Selector */
    .meal-selector {
      display: flex;
      margin-bottom: 20px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 6px;
      overflow: hidden;
    }
    
    .meal-tab {
      flex: 1;
      text-align: center;
      padding: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .meal-tab.active {
      background: rgba(45, 137, 239, 0.3);
      color: #2d89ef;
      font-weight: bold;
    }
    
    .meal-tab:not(.active):hover {
      background: rgba(255, 255, 255, 0.1);
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

  <div class="nutrition-container">
    <div class="nutrition-header">
      <h1>Nutrition Logger</h1>
      <p>Track your meals and monitor your macros</p>
    </div>
    
    <div class="meal-selector">
      <div class="meal-tab active" onclick="changeMeal('breakfast')">Breakfast</div>
      <div class="meal-tab" onclick="changeMeal('lunch')">Lunch</div>
      <div class="meal-tab" onclick="changeMeal('dinner')">Dinner</div>
      <div class="meal-tab" onclick="changeMeal('snacks')">Snacks</div>
    </div>
    
    <div class="nutrition-grid">
      <div class="nutrition-card">
        <h2><i>⚡</i> Quick Log</h2>
        <div class="quick-log-items">
          <div class="quick-log-item" onclick="quickAdd('breakfast')">
            <i>🍳</i>
            <div>Breakfast</div>
          </div>
          <div class="quick-log-item" onclick="quickAdd('salad')">
            <i>🥗</i>
            <div>Salad</div>
          </div>
          <div class="quick-log-item" onclick="quickAdd('protein')">
            <i>🍗</i>
            <div>Protein</div>
          </div>
          <div class="quick-log-item" onclick="quickAdd('smoothie')">
            <i>🥤</i>
            <div>Smoothie</div>
          </div>
          <div class="quick-log-item" onclick="quickAdd('snack')">
            <i>🍎</i>
            <div>Snack</div>
          </div>
          <div class="quick-log-item" onclick="quickAdd('water')">
            <i>💧</i>
            <div>Water</div>
          </div>
        </div>
        
        <h2><i>✏️</i> Manual Entry</h2>
        <div class="form-group">
          <label for="foodName">Food Name</label>
          <input type="text" id="foodName" class="form-control" placeholder="e.g., Grilled Chicken">
        </div>
        <div class="form-group">
          <label for="foodCalories">Calories</label>
          <input type="number" id="foodCalories" class="form-control" placeholder="kcal">
        </div>
        <div class="form-group">
          <label>Macronutrients (grams)</label>
          <div class="macro-grid">
            <input type="number" id="foodProtein" class="form-control" placeholder="Protein">
            <input type="number" id="foodCarbs" class="form-control" placeholder="Carbs">
            <input type="number" id="foodFat" class="form-control" placeholder="Fat">
            <input type="number" id="foodFiber" class="form-control" placeholder="Fiber">
          </div>
        </div>
        <div class="form-group">
          <label for="foodServing">Serving Size</label>
          <input type="text" id="foodServing" class="form-control" placeholder="e.g., 1 cup, 100g">
        </div>
        <button class="btn btn-primary" onclick="addManualEntry()">Log Food</button>
      </div>
      
      <div class="nutrition-card">
        <h2><i>📊</i> Nutrition Dashboard</h2>
        <div class="dashboard">
          <h3>Today's Summary</h3>
          <div class="macro-circles">
            <div class="macro-circle">
              <div class="macro-name">Calories</div>
              <div class="macro-value" id="caloriesValue">0</div>
              <div class="macro-target">/ 2,000</div>
            </div>
            <div class="macro-circle">
              <div class="macro-name">Protein</div>
              <div class="macro-value" id="proteinValue">0</div>
              <div class="macro-target">g</div>
            </div>
            <div class="macro-circle">
              <div class="macro-name">Carbs</div>
              <div class="macro-value" id="carbsValue">0</div>
              <div class="macro-target">g</div>
            </div>
            <div class="macro-circle">
              <div class="macro-name">Fat</div>
              <div class="macro-value" id="fatValue">0</div>
              <div class="macro-target">g</div>
            </div>
          </div>
        </div>
        
        <h3>Today's Food Log</h3>
        <div class="food-log" id="foodLog">
          <!-- Food items will appear here -->
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
    
    // Current meal time
    let currentMeal = 'breakfast';
    
    // Change meal time
    function changeMeal(meal) {
      currentMeal = meal;
      document.querySelectorAll('.meal-tab').forEach(tab => {
        tab.classList.remove('active');
      });
      event.target.classList.add('active');
    }
    
    // Sample foods for quick add
    const quickFoods = {
      breakfast: { name: "Breakfast", calories: 300, protein: 20, carbs: 35, fat: 10 },
      salad: { name: "Salad", calories: 200, protein: 10, carbs: 15, fat: 12 },
      protein: { name: "Protein", calories: 250, protein: 30, carbs: 5, fat: 12 },
      smoothie: { name: "Smoothie", calories: 180, protein: 15, carbs: 25, fat: 5 },
      snack: { name: "Snack", calories: 150, protein: 5, carbs: 20, fat: 7 },
      water: { name: "Water", calories: 0, protein: 0, carbs: 0, fat: 0 }
    };
    
    // Quick add food
    function quickAdd(type) {
      const food = quickFoods[type];
      addToLog(food);
      alert(`Added ${food.name} to ${currentMeal}`);
    }
    
    // Add manual entry
    function addManualEntry() {
      const name = document.getElementById('foodName').value.trim();
      const calories = parseInt(document.getElementById('foodCalories').value) || 0;
      const protein = parseInt(document.getElementById('foodProtein').value) || 0;
      const carbs = parseInt(document.getElementById('foodCarbs').value) || 0;
      const fat = parseInt(document.getElementById('foodFat').value) || 0;
      
      if (!name || isNaN(calories)) {
        alert("Please at least enter a food name and calories");
        return;
      }
      
      const food = {
        name: name,
        calories: calories,
        protein: protein,
        carbs: carbs,
        fat: fat
      };
      
      addToLog(food);
      
      // Clear form
      document.getElementById('foodName').value = '';
      document.getElementById('foodCalories').value = '';
      document.getElementById('foodProtein').value = '';
      document.getElementById('foodCarbs').value = '';
      document.getElementById('foodFat').value = '';
      document.getElementById('foodFiber').value = '';
    }
    
    // Add to food log
    function addToLog(food) {
      const foodLog = document.getElementById('foodLog');
      const foodItem = document.createElement('div');
      foodItem.className = 'food-item';
      foodItem.dataset.calories = food.calories;
      foodItem.dataset.protein = food.protein;
      foodItem.dataset.carbs = food.carbs;
      foodItem.dataset.fat = food.fat;
      
      foodItem.innerHTML = `
        <div class="food-info">
          <div class="food-name">${food.name}</div>
          <div class="food-macros">P: ${food.protein}g • C: ${food.carbs}g • F: ${food.fat}g</div>
        </div>
        <div class="food-calories">${food.calories} kcal</div>
        <button class="food-delete" onclick="this.parentElement.remove(); updateDashboard()">×</button>
      `;
      
      foodLog.prepend(foodItem);
      updateDashboard();
    }
    
    // Update dashboard with calculations
    function updateDashboard() {
      const foodItems = document.querySelectorAll('.food-item');
      let totals = {
        calories: 0,
        protein: 0,
        carbs: 0,
        fat: 0
      };

      foodItems.forEach(item => {
        totals.calories += parseInt(item.dataset.calories) || 0;
        totals.protein += parseInt(item.dataset.protein) || 0;
        totals.carbs += parseInt(item.dataset.carbs) || 0;
        totals.fat += parseInt(item.dataset.fat) || 0;
      });

      // Update the dashboard
      document.getElementById('caloriesValue').textContent = totals.calories;
      document.getElementById('proteinValue').textContent = totals.protein;
      document.getElementById('carbsValue').textContent = totals.carbs;
      document.getElementById('fatValue').textContent = totals.fat;
    }
    
    function logout() {
      localStorage.removeItem("user");
      window.location.href = "login.html";
    }
    
    // Initialize
    updateDashboard();
  </script>
</body>
</html>