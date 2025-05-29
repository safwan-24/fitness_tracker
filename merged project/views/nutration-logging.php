

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nutrition Logging</title>
  <link rel="stylesheet" href="../assets/styles/nutrition-logging.css" />
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>

<h1>Nutrition Logging</h1>


<nav>
  <button class="tab-btn active" data-tab="foodDiary">Food Diary</button>
  <button class="tab-btn" data-tab="barcodeScanner">Barcode Scanner</button>
</nav>

<section id="foodDiary" class="tab-content active">
  <h2>Food Diary</h2>

  <form id="foodForm" method="POST" action="../controller/nutrition_logging.php" onsubmit="return validateForm()">
    <select id="commonMeals" onchange="quickAdd(this)">
      <option value="">-- Quick-add common meal --</option>
      <option value="Banana|105|1.3|27|0.3">Banana</option>
      <option value="Chicken Breast|165|31|0|3.6">Chicken Breast</option>
      <option value="Rice (1 cup)|205|4.3|45|0.4">Rice (1 cup)</option>
    </select>
    <br/>
    <label>Food Name: <input type="text" name="foodName" id="foodName" required /></label><br/>
    <label>Calories: <input type="number" name="foodCalories" id="foodCalories" min="1" required /></label><br/>
    <label>Protein (g): <input type="number" name="foodProtein" id="foodProtein" step="0.1" min="0" /></label><br/>
    <label>Carbs (g): <input type="number" name="foodCarbs" id="foodCarbs" step="0.1" min="0" /></label><br/>
    <label>Fat (g): <input type="number" name="foodFat" id="foodFat" step="0.1" min="0" /></label><br/>
    <button type="submit">Add Food</button>
  </form>

  <h3>Food Diary Log:</h3>

</section>

<section id="barcodeScanner" class="tab-content" style="display:none;">
  <h2>Barcode Scanner</h2>
  <p>Enter barcode (mock scan):</p>
  <input type="text" id="barcodeInput" placeholder="e.g. 0123456789012" />
  <button id="scanBtn">Scan & Add Food</button>
  <div id="scanResult"></div>
</section>

  <script src="../assets/scripts/nutration-logging.js"></script>


</body>
</html>
