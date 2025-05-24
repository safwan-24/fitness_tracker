let timerInterval;
let seconds = 0;

function formatTime(s) {
  const hrs = String(Math.floor(s / 3600)).padStart(2, '0');
  const mins = String(Math.floor((s % 3600) / 60)).padStart(2, '0');
  const secs = String(s % 60).padStart(2, '0');
  return `${hrs}:${mins}:${secs}`;
}

function startStopTimer() {
  if (timerInterval) {
    clearInterval(timerInterval);
    timerInterval = null;
  } else {
    timerInterval = setInterval(() => {
      seconds++;
      document.getElementById('timer').textContent = formatTime(seconds);
    }, 1000);
  }
}

document.getElementById('workoutForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const exercise = document.getElementById('exercise').value;
  const sets = document.getElementById('sets').value;
  const reps = document.getElementById('reps').value;
  const weight = document.getElementById('weight').value;
  const notes = document.getElementById('notes').value;

  const summaryItem = document.createElement('li');
  summaryItem.textContent = `Exercise: ${exercise}, Sets: ${sets}, Reps: ${reps}, Weight: ${weight}kg, Notes: ${notes}`;

  document.getElementById('sessionList').appendChild(summaryItem);
  this.reset();
});
