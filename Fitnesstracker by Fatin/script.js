// Image Preview
document.getElementById('avatarInput').addEventListener('change', function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const preview = document.getElementById('avatarPreview');
      preview.src = e.target.result;
      preview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
});

// Form Validation and Submission
document.getElementById('editProfileForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const fullName = document.getElementById('fullname').value.trim();
  const email = document.getElementById('email').value.trim();
  const fileInput = document.getElementById('avatarInput');
  const errorElem = document.getElementById('formError');

  // Reset error message
  errorElem.textContent = "";

  // Basic validation
  if (fullName === "" || email === "") {
    errorElem.textContent = "Full name and email are required.";
    return;
  }

  // Email pattern validation
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    errorElem.textContent = "Please enter a valid email address.";
    return;
  }

  // Optional: validate image file type and size
  const file = fileInput.files[0];
  if (file) {
    const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    const maxSize = 2 * 1024 * 1024; // 2MB

    if (!allowedTypes.includes(file.type)) {
      errorElem.textContent = "Only JPG, PNG, or GIF files are allowed.";
      return;
    }

    if (file.size > maxSize) {
      errorElem.textContent = "Image must be less than 2MB.";
      return;
    }
  }

  // If all validation passes
  alert("Profile updated successfully!");
  this.reset();
  document.getElementById('avatarPreview').style.display = 'none';
});
