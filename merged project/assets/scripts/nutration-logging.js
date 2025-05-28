function quickAdd(select) {
  const val = select.value; // format: "name|calories|protein|carbs|fat"
  if (!val) return;

  const parts = val.split("|");
  if (parts.length !== 5) return;

  document.getElementById("foodName").value = parts[0];
  document.getElementById("foodCalories").value = parts[1];
  document.getElementById("foodProtein").value = parts[2];
  document.getElementById("foodCarbs").value = parts[3];
  document.getElementById("foodFat").value = parts[4];
}

function validateForm() {
  const name = document.getElementById("foodName").value.trim();
  const calories = Number(document.getElementById("foodCalories").value);
  const protein = Number(document.getElementById("foodProtein").value) || 0;
  const carbs = Number(document.getElementById("foodCarbs").value) || 0;
  const fat = Number(document.getElementById("foodFat").value) || 0;

  if (!name) {
    alert("Food name is required.");
    return false;
  }

  if (!(calories > 0)) {
    alert("Calories must be a positive number.");
    return false;
  }

  if (protein < 0 || carbs < 0 || fat < 0) {
    alert("Protein, Carbs, and Fat cannot be negative.");
    return false;
  }
  return true;
}

// Tab switching logic
document.querySelectorAll(".tab-btn").forEach(btn => {
  btn.addEventListener("click", () => {
    document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
    document.querySelectorAll(".tab-content").forEach(sec => sec.style.display = "none");

    btn.classList.add("active");
    document.getElementById(btn.getAttribute("data-tab")).style.display = "block";
  });
});