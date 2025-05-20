// Validate Edit Profile
document.getElementById('editProfileForm').addEventListener('submit', function (e) {
  let valid = true;
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const nameError = document.getElementById('nameError');
  const emailError = document.getElementById('emailError');

  nameError.textContent = '';
  emailError.textContent = '';

  if (name === '') {
    nameError.textContent = 'Name is required.';
    valid = false;
  }

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    emailError.textContent = 'Please enter a valid email.';
    valid = false;
  }

  if (!valid) e.preventDefault();
});

// Avatar upload preview
document.getElementById('avatar').addEventListener('change', function () {
  const file = this.files[0];
  const preview = document.getElementById('avatarPreview');
  const error = document.getElementById('avatarError');
  error.textContent = '';

  if (file) {
    if (!file.type.startsWith('image/')) {
      error.textContent = 'Only image files are allowed.';
      this.value = '';
      preview.style.display = 'none';
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
});

// Validate Password Update
document.getElementById('passwordForm').addEventListener('submit', function (e) {
  const current = document.getElementById('currentPassword').value.trim();
  const newPass = document.getElementById('newPassword').value.trim();
  const confirmPass = document.getElementById('confirmPassword').value.trim();
  const error = document.getElementById('passwordError');

  error.textContent = '';
  let valid = true;

  if (!current || !newPass || !confirmPass) {
    error.textContent = 'All password fields are required.';
    valid = false;
  } else if (newPass.length < 6) {
    error.textContent = 'New password must be at least 6 characters.';
    valid = false;
  } else if (newPass !== confirmPass) {
    error.textContent = 'Passwords do not match.';
    valid = false;
  }

  if (!valid) e.preventDefault();
});
