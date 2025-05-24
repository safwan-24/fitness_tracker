document.getElementById('workoutForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const program = document.getElementById('program').value;
  const goal = document.getElementById('goal').value;
  const startDate = document.getElementById('startDate').value;

  const details = `
    Duration: ${program} weeks<br>
    Goal: ${goal.replace('_', ' ')}<br>
    Start Date: ${new Date(startDate).toDateString()}
  `;

  document.getElementById('programDetails').innerHTML = details;
  document.getElementById('confirmation').classList.remove('hidden');
});
