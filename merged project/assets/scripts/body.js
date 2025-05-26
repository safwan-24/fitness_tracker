document.getElementById("measureForm").addEventListener("submit", function(event) {
  event.preventDefault(); // prevent form from submitting normally

  // Get values
  const weight = parseFloat(document.getElementById("weight").value);
  const waist = parseFloat(document.getElementById("waist").value);
  const chest = parseFloat(document.getElementById("chest").value);

  // Validation
  if (isNaN(weight) || weight <= 0) {
    alert("Please enter a valid weight greater than 0.");
    return;
  }

  if (isNaN(waist) || waist <= 0) {
    alert("Please enter a valid waist measurement greater than 0.");
    return;
  }

  if (isNaN(chest) || chest <= 0) {
    alert("Please enter a valid chest measurement greater than 0.");
    return;
  } 

  // Save to history
  const historyList = document.getElementById("history");
  const entry = document.createElement("li");
  const date = new Date().toLocaleDateString();
  entry.textContent = `${date} - Weight: ${weight}kg, Waist: ${waist}cm, Chest: ${chest}cm`;
  historyList.appendChild(entry);

  // Clear form
  document.getElementById("measureForm").reset();
});
