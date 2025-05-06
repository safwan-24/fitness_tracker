let count = 0;

function logWater() {
  count++;
  document.getElementById("count").textContent = count;

  // Reminder message
  if (count >= 8) {
    document.getElementById("reminder").textContent = "Great job staying hydrated!";
  } else {
    document.getElementById("reminder").textContent = `Keep going! Only ${8 - count} left.`;
  }
}
