
  // Hydration form validation
  document.getElementById('hydrationForm').addEventListener('submit', function (e) {
    const amount = document.getElementById('amount').value;
    const amountError = document.getElementById('amountError');
    amountError.textContent = '';
    
    if (amount === '' || amount <= 0) {
      amountError.textContent = 'Please enter a valid amount.';
      e.preventDefault();
    }
  });

  // Reminder form validation
  document.getElementById('reminderForm').addEventListener('submit', function (e) {
    let valid = true;

    const goal = document.getElementById('goal').value;
    const interval = document.getElementById('reminderTime').value;

    const goalError = document.getElementById('goalError');
    const reminderError = document.getElementById('reminderError');

    goalError.textContent = '';
    reminderError.textContent = '';

    if (goal === '' || goal <= 0) {
      goalError.textContent = 'Enter a positive daily goal.';
      valid = false;
    }

    if (interval === '') {
      reminderError.textContent = 'Please select a reminder interval.';
      valid = false;
    }

    if (!valid) e.preventDefault();
  });
