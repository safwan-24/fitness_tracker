const form = document.getElementById("measureForm");
const historyList = document.getElementById("history");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const weight = document.getElementById("weight").value;
  const waist = document.getElementById("waist").value;
  const chest = document.getElementById("chest").value;

  const entry = `Weight: ${weight}kg, Waist: ${waist}cm, Chest: ${chest}cm - ${new Date().toLocaleDateString()}`;

  const li = document.createElement("li");
  li.textContent = entry;
  historyList.appendChild(li);

  form.reset();
});
