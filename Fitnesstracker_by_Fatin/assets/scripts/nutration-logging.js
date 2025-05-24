const log = [];

  function addFood() {
    const name = document.getElementById('foodName').value;
    const calories = document.getElementById('foodCalories').value;
    const protein = document.getElementById('foodProtein').value || 0;
    const carbs = document.getElementById('foodCarbs').value || 0;
    const fat = document.getElementById('foodFat').value || 0;

    const entry = {
      name, calories, protein, carbs, fat
    };

    log.push(entry);
    renderLog();
    document.getElementById('nutritionForm').reset();
  }

  function renderLog() {
    const logDiv = document.getElementById('foodLog');
    logDiv.innerHTML = "";
    log.forEach(item => {
      logDiv.innerHTML += `
        <div class="log-entry">
          <strong>${item.name}</strong><br>
          Calories: ${item.calories}, Protein: ${item.protein}g, Carbs: ${item.carbs}g, Fat: ${item.fat}g
        </div>
      `;
    });
  }