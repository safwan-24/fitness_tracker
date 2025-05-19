document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("editProfileForm");
  const fullnameInput = document.getElementById("fullname");
  const emailInput = document.getElementById("email");
  const avatarInput = document.getElementById("avatarInput");
  const avatarPreview = document.getElementById("avatarPreview");
  const formError = document.getElementById("formError");

  // Image Preview Handler
  avatarInput.addEventListener("change", function () {
    const file = avatarInput.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (e) {
        avatarPreview.src = e.target.result;
        avatarPreview.style.display = "block";
      };
      reader.readAsDataURL(file);
    } else {
      avatarPreview.src = "#";
      avatarPreview.style.display = "none";
    }
  });

  // Form Validation
  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent actual form submission

    const fullname = fullnameInput.value.trim();
    const email = emailInput.value.trim();
    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

    formError.textContent = ""; // Clear previous error

    if (fullname === "") {
      formError.textContent = "Full Name is required.";
      return;
    }

    if (email === "") {
      formError.textContent = "Email is required.";
      return;
    }

    if (!emailPattern.test(email)) {
      formError.textContent = "Please enter a valid email address.";
      return;
    }

    // If all validations pass
    alert("Profile updated successfully!");
    form.reset();
    avatarPreview.src = "#";
    avatarPreview.style.display = "none";
  });
});
