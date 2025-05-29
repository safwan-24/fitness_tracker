document.getElementById('workoutForm').addEventListener('submit', function (e) {
  e.preventDefault(); // Prevent traditional form submission

  // Get form values
  const program = document.getElementById('program').value;
  const goal = document.getElementById('goal').value;
  const startDate = document.getElementById('startDate').value;

  // Validation
  const errors = [];
  
  if (!program) {
    errors.push("Please select a program duration");
  }
  
  if (!goal) {
    errors.push("Please select a workout goal");
  }
  
  if (!startDate) {
    errors.push("Please select a start date");
  } else {
    // Validate if date is not in the past
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const selectedDate = new Date(startDate);
    if (selectedDate < today) {
      errors.push("Start date cannot be in the past");
    }
  }

  // If there are validation errors, show them
  if (errors.length > 0) {
    const errorMessage = errors.join("\n");
    alert(errorMessage);
    return;
  }

  // Prepare data for AJAX submission
  const formData = {
    program: program,
    goal: goal,
    startDate: startDate
  };

  // AJAX submission
  fetch('../controller/workout-plans.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formData)
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Workout plan created successfully!');
      window.location.href = 'workout-plans.php?message=' + encodeURIComponent('Workout plan created successfully!');
    } else {
      alert('Error: ' + (data.message || 'Failed to create workout plan'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred while submitting the form');
  });
});
