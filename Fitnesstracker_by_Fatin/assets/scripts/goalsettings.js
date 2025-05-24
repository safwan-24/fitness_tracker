  let targetValue = 0;

    function setGoal() {
      const name = document.getElementById("goalName").value.trim();
      const target = parseFloat(document.getElementById("target").value);
      const current = parseFloat(document.getElementById("current").value);
      const errorBox = document.getElementById("errorBox");

      if (!name || isNaN(target) || isNaN(current) || target <= 0 || current < 0 || current > target) {
        errorBox.textContent = "Please enter valid goal data.";
        return;
      }

      errorBox.textContent = "";
      targetValue = target;

      // Hide form
      document.getElementById("goalFormCard").classList.add("hidden");

      // Setup invisible progress tracker
      const slider = document.getElementById("progressBar");
      slider.max = target;
      slider.value = current;
      slider.style.opacity = 0;
      slider.focus(); // optionally keep focus on invisible input
    }

    function checkProgress() {
      const value = parseFloat(document.getElementById("progressBar").value);
      if (value >= targetValue) {
        document.getElementById("trophy").classList.remove("hidden");
      }
    }