
document.getElementById('workoutForm').addEventListener('submit', function (e) {

  const program = document.getElementById('program').value;
  const goal = document.getElementById('goal').value;
  const startDate = document.getElementById('startDate').value;

  if (!program || !goal || !startDate) {
    alert("Please fill out all fields.");
    return;
  }

  // Optional: show a simple alert confirmation (not mandatory)
  alert(`Starting your ${program}-week program for goal: ${goal.replace('_', ' ')} from ${startDate}`);
});
