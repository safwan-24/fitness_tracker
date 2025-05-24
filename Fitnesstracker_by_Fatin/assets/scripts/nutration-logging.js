// --- Tab navigation ---
const tabs = document.querySelectorAll(".tab-btn");
const tabContents = document.querySelectorAll(".tab-content");

tabs.forEach(btn => {
  btn.addEventListener("click", () => {
    tabs.forEach(b => b.classList.remove("active"));
    tabContents.forEach(c => c.classList.remove("active"));

    btn.classList.add("active");
    document.getElementById(btn.dataset.tab).classList.add("active");
  });
});

// --- Food Diary functionality ---
const log = [];

const foodForm = document.getElementById("foodForm");
const foodLogDiv = document.getElementById("foodLog");
const commonMealsSelect = document.getElementById("commonMeals");

commonMealsSelect.addEventListener("change", () => {
  if (!commonMealsSelect.value) return;
  const meal = JSON.parse(commonMealsSelect.value);
  document.getElementById("foodName").value = meal.name;
  document.getElementById("foodCalories").value = meal.calories;
  document.getElementById("foodProtein").value = meal.protein;
  document.getElementById("foodCarbs").value = meal.carbs;
  document.getElementById("foodFat").value = meal.fat;
});

foodForm.addEventListener("submit", e => {
  e.preventDefault();

  const name = document.getElementById("foodName").value.trim();
  const calories = parseFloat(document.getElementById("foodCalories").value);
  const protein = parseFloat(document.getElementById("foodProtein").value) || 0;
  const carbs = parseFloat(document.getElementById("foodCarbs").value) || 0;
  const fat = parseFloat(document.getElementById("foodFat").value) || 0;

  if (!name) {
    alert("Food name is required.");
    return;
  }
  if (isNaN(calories) || calories <= 0) {
    alert("Calories must be a positive number.");
    return;
  }
  if (protein < 0 || carbs < 0 || fat < 0) {
    alert("Macro nutrients cannot be negative.");
    return;
  }

  log.push({ name, calories, protein, carbs, fat });
  renderLog();
  foodForm.reset();
  commonMealsSelect.value = "";
});

function renderLog() {
  foodLogDiv.innerHTML = "";
  log.forEach((item, idx) => {
    foodLogDiv.innerHTML += `
      <div class="log-entry">
        <strong>${item.name}</strong><br>
        Calories: ${item.calories.toFixed(1)}, Protein: ${item.protein.toFixed(1)}g, Carbs: ${item.carbs.toFixed(1)}g, Fat: ${item.fat.toFixed(1)}g
      </div>
    `;
  });
  updateChart();
}

// --- Barcode Scanner mock ---
const barcodeDB = {
  "0123456789012": { name: "Granola Bar", calories: 150, protein: 3, carbs: 22, fat: 5 },
  "0987654321098": { name: "Yogurt Cup", calories: 120, protein: 6, carbs: 16, fat: 2 },
};

document.getElementById("scanBtn").addEventListener("click", () => {
  const code = document.getElementById("barcodeInput").value.trim();
  const resultDiv = document.getElementById("scanResult");
  if (!code) {
    alert("Please enter a barcode.");
    return;
  }
  if (barcodeDB[code]) {
    const food = barcodeDB[code];
    log.push(food);
    renderLog();
    resultDiv.textContent = `Added: ${food.name}`;
    document.getElementById("barcodeInput").value = "";
  } else {
    resultDiv.textContent = "Barcode not found in database.";
  }
});

// --- Macro Dashboard Chart ---
const ctx = document.getElementById("macroChart").getContext("2d");
let macroChart;

function updateChart() {
  const totals = log.reduce(
    (acc, item) => {
      acc.protein += item.protein;
      acc.carbs += item.carbs;
      acc.fat += item.fat;
      return acc;
    },
    { protein: 0, carbs: 0, fat: 0 }
  );

  const data = [totals.protein, totals.carbs, totals.fat];
  if (macroChart) {
    macroChart.data.datasets[0].data = data;
    macroChart.update();
  } else {
    macroChart = new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["Protein (g)", "Carbs (g)", "Fat (g)"],
        datasets: [{
          data: data,
          backgroundColor: ["#36A2EB", "#FFCE56", "#FF6384"],
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: "bottom" }
        }
      }
    });
  }

  document.getElementById("macroSummary").textContent = `Total Protein: ${totals.protein.toFixed(1)}g, Carbs: ${totals.carbs.toFixed(1)}g, Fat: ${totals.fat.toFixed(1)}g`;
}

// Initialize empty chart
updateChart();
