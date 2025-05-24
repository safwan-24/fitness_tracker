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
  <form id="foodForm">
    <select id="commonMeals">
      <option value="">-- Quick-add common meal --</option>
      <option value='{"name":"Banana","calories":105,"protein":1.3,"carbs":27,"fat":0.3}'>Banana</option>
      <option value='{"name":"Chicken Breast","calories":165,"protein":31,"carbs":0,"fat":3.6}'>Chicken Breast</option>
      <option value='{"name":"Rice (1 cup)","calories":205,"protein":4.3,"carbs":45,"fat":0.4}'>Rice (1 cup)</option>
    </select>
    <br/>
    <label>
      Food Name: <input type="text" id="foodName" required />
    </label><br/>
    <label>
      Calories: <br><input type="number" id="foodCalories" min="1" required />
    </label><br/>
    <label>
      Protein (g): <input type="number" id="foodProtein" min="0" step="0.1" />
    </label><br/>
    <label>
      Carbs (g): <input type="number" id="foodCarbs" min="0" step="0.1" />
    </label><br/>
    <label>
      Fat (g):<br> <input type="number" id="foodFat" min="0" step="0.1" />
    </label><br/>
    <button type="submit">Add Food</button>
  </form>
  <h3>Food Diary Log:</h3>
  <div id="foodLog"></div>
</section>

<section id="barcodeScanner" class="tab-content">
  <h2>Barcode Scanner</h2>
  <p>Enter barcode (mock scan):</p>
  <input type="text" id="barcodeInput" placeholder="e.g. 0123456789012" />
  <button id="scanBtn">Scan & Add Food</button>
  <div id="scanResult"></div>
</section>

<script src="../assets/scripts/nutration-logging.js"></script>

</body>
</html>
