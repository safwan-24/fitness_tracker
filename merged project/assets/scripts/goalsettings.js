document.getElementById('goalForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const title = this.title.value.trim();
  const type = this.type.value.trim();
  const targetValue = parseInt(this.targetValue.value, 10);
  const unit = this.unit.value.trim();
  const targetDate = this.targetDate.value;

  const msgDiv = document.getElementById('message');

  if (!title || !type || !unit || !targetDate || isNaN(targetValue) || targetValue <= 0) {
    msgDiv.style.color = 'red';
    msgDiv.textContent = 'Please fill out all fields correctly.';
    return;
  }

  const data = {
    title,
    type,
    targetValue,
    unit,
    targetDate
  };

  fetch(this.action, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      msgDiv.style.color = 'green';
      msgDiv.textContent = 'Goal created successfully!';
      this.reset();
    } else {
      msgDiv.style.color = 'red';
      msgDiv.textContent = 'Error: ' + (result.message || 'Something went wrong');
    }
  })
  .catch(error => {
    msgDiv.style.color = 'red';
    msgDiv.textContent = 'Network error: ' + error.message;
  });
});
