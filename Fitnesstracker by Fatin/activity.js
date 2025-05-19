// activity.js

function clearErrors() {
  document.querySelectorAll('.error-msg').forEach(el => el.remove());
}

function showError(inputEl, message) {
  const err = document.createElement('div');
  err.className = 'error-msg';
  err.style.color = 'red';
  err.style.fontSize = '0.9em';
  err.textContent = message;
  inputEl.parentNode.appendChild(err);
}

function validateForm() {
  clearErrors();

  const dateEl   = document.getElementById('logDate');
  const userEl   = document.getElementById('logUser');
  const actionEl = document.getElementById('logAction');

  let valid = true;
  const today = new Date().toISOString().split('T')[0];

  // Date validation: optional, but if filled must NOT be in the future
  if (dateEl.value && dateEl.value > today) {
    showError(dateEl, 'Date cannot be in the future.');
    valid = false;
  }

  // User validation: required and alphanumeric (letters, numbers, underscore)
  if (!userEl.value.trim()) {
    showError(userEl, 'Username is required.');
    valid = false;
  } else if (!/^\w+$/.test(userEl.value.trim())) {
    showError(userEl, 'Username must be alphanumeric.');
    valid = false;
  }

  // Action validation: required and letters only
  if (!actionEl.value.trim()) {
    showError(actionEl, 'Action type is required.');
    valid = false;
  } else if (!/^[A-Za-z]+$/.test(actionEl.value.trim())) {
    showError(actionEl, 'Action type must contain letters only.');
    valid = false;
  }

  return valid;
}

function filterLogs() {
  if (!validateForm()) return;

  // Your filtering logic here...
  alert('Filters applied (this is a placeholder)');
}

function exportLogs() {
  if (!validateForm()) return;

  // Your export logic here...
  alert('Export started (this is a placeholder)');
}

// Optional: Attach event listeners programmatically instead of inline onclick
document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('.form-buttons button:nth-child(1)').onclick = filterLogs;
  document.querySelector('.form-buttons button:nth-child(2)').onclick = exportLogs;
});
