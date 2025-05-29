document.getElementById('goalForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const data = {
    title: this.title.value.trim(),
    type: this.type.value.trim(),
    targetValue: parseInt(this.targetValue.value, 10),
    unit: this.unit.value.trim(),
    targetDate: this.targetDate.value
  };

  fetch(this.action, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(result => {
    const msgDiv = document.getElementById('message');
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
    alert('Network error: ' + error.message);
  });
});
