// Nutrition Data
let todaysLog = [];
const macroGoals = { calories: 2000, protein: 150, carbs: 200, fat: 65 };

// Quick Add Meal
function addQuickMeal() {
  const meal = document.getElementById('quickMeals').value;
  if (!meal) return;

  const meals = {
    breakfast_standard: { name: "Standard Breakfast", calories: 300, protein: 20, carbs: 35, fat: 10 },
    lunch_salad: { name: "Grilled Chicken Salad", calories: 450, protein: 40, carbs: 15, fat: 25 },
    dinner_pasta: { name: "Pasta", calories: 600, protein: 25, carbs: 80, fat: 20 }
  };

  addToLog(meals[meal]);
  alert(`Added ${meals[meal].name}`);
}

// Barcode Scanner (Simulated)
function scanBarcode() {
  const barcode = document.getElementById('barcodeInput').value;
  if (!barcode) {
    alert("Please enter a barcode!");
    return;
  }

  // Simulated API response
  const barcodeResult = document.getElementById('barcodeResult');
  barcodeResult.innerHTML = "<p>Scanning...</p>";

  setTimeout(() => {
    const fakeDatabase = {
      "123456": { name: "Protein Bar", calories: 200, protein: 20, carbs: 15, fat: 5 },
      "789012": { name: "Sports Drink", calories: 150, protein: 0, carbs: 38, fat: 0 }
    };

    if (fakeDatabase[barcode]) {
      const item = fakeDatabase[barcode];
      barcodeResult.innerHTML = `
        <p>Found: <strong>${item.name}</strong></p>
        <button onclick="addToLog(${JSON.stringify(item)})" class="action-btn">Add to Log</button>
      `;
    } else {
      barcodeResult.innerHTML = "<p>Product not found. Try manual entry.</p>";
    }
  }, 1500);
}

// Manual Entry
function addManualEntry() {
  const food = document.getElementById('foodName').value;
  const calories = parseInt(document.getElementById('calories').value);
  const protein = parseInt(document.getElementById('protein').value);
  const carbs = parseInt(document.getElementById('carbs').value);
  const fat = parseInt(document.getElementById('fat').value);

  if (!food || isNaN(calories)) {
    alert("Please at least enter a food name and calories!");
    return;
  }

  addToLog({
    name: food,
    calories: calories || 0,
    protein: protein || 0,
    carbs: carbs || 0,
    fat: fat || 0
  });

  // Clear inputs
  document.getElementById('foodName').value = '';
  document.getElementById('calories').value = '';
  document.getElementById('protein').value = '';
  document.getElementById('carbs').value = '';
  document.getElementById('fat').value = '';
}

// Add to Log and Update Dashboard
function addToLog(foodItem) {
  todaysLog.push(foodItem);
  updateDashboard();
  updateFoodLog();
}

// Update Macro Dashboard
function updateDashboard() {
  const totals = todaysLog.reduce((acc, item) => {
    acc.calories += item.calories;
    acc.protein += item.protein;
    acc.carbs += item.carbs;
    acc.fat += item.fat;
    return acc;
  }, { calories: 0, protein: 0, carbs: 0, fat: 0 });

  document.getElementById('caloriesValue').textContent = totals.calories;
  document.getElementById('proteinValue').textContent = `${totals.protein}g`;
  document.getElementById('carbsValue').textContent = `${totals.carbs}g`;
  document.getElementById('fatValue').textContent = `${totals.fat}g`;

  // Update calorie progress
  const progress = Math.min((totals.calories / macroGoals.calories) * 100, 100);
  document.querySelector('.macro-circle:nth-child(1)').style.background = `
    conic-gradient(red ${progress}%, #222 ${progress}%)
  `;
}

// Update Food Log List
function updateFoodLog() {
  const logDiv = document.getElementById('foodLog');
  logDiv.innerHTML = '';

  todaysLog.forEach(item => {
    const entry = document.createElement('div');
    entry.innerHTML = `
      <span>${item.name}</span>
      <span>${item.calories} cal</span>
    `;
    logDiv.appendChild(entry);
  });
}

// Initialize (demo data)
document.addEventListener('DOMContentLoaded', () => {
  addToLog({ name: "Sample Meal", calories: 500, protein: 30, carbs: 50, fat: 15 });
});