document.getElementById("challengeForm").addEventListener("submit", function (e) {
  e.preventDefault();

  // Clear previous errors
  const errorMessages = this.querySelectorAll(".error-message");
  errorMessages.forEach(msg => (msg.textContent = ""));

  let valid = true;

  const nameInput = this.challengeName;
  const typeInput = this.challengeType;
  const targetInput = this.target;

  // Validate Challenge Name
  if (!nameInput.value.trim()) {
    showError(nameInput, "Challenge name is required.");
    valid = false;
  }

  // Validate Challenge Type
  if (!typeInput.value) {
    showError(typeInput, "Please select a challenge type.");
    valid = false;
  }

  // Validate Target (positive integer)
  if (!targetInput.value || isNaN(targetInput.value) || Number(targetInput.value) < 1) {
    showError(targetInput, "Target must be a positive number.");
    valid = false;
  }

  if (valid) {
    alert(`Challenge Created!\nName: ${nameInput.value}\nType: ${typeInput.value}\nTarget: ${targetInput.value}`);
    this.reset();
  }
});

function showError(input, message) {
  const error = input.parentElement.querySelector(".error-message");
  error.textContent = message;
  input.focus();
}
