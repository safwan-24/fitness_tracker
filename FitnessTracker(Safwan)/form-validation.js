// Wait for the DOM to load
window.onload = function () {
  const loginForm = document.getElementById("loginForm");
  const signupForm = document.getElementById("signupForm");
  const forgotForm = document.getElementById("forgotForm");

  // Login Form
  if (loginForm) {
    loginForm.onsubmit = function (e) {
      e.preventDefault();

      const email = document.getElementsByName("email")[0].value.trim();
      const password = document.getElementsByName("password")[0].value.trim();

      if (email === "" || password === "") {
        alert("Please fill in both email and password.");
        return false;
      }

      // Admin login check
      if (email === "admin@email.com" && password === "123") {
        window.location.href = "admin.html";
        return true;
      }

      alert("Login successful (demo only)");
      // In real implementation, send credentials to the server here
    };
  }

  // Signup Form
  if (signupForm) {
    signupForm.onsubmit = function (e) {
      e.preventDefault();

      const name = document.getElementsByName("name")[0].value.trim();
      const email = document.getElementsByName("email")[0].value.trim();
      const password = document.getElementsByName("password")[0].value.trim();
      const confirmPassword = document.getElementsByName("confirmPassword")[0].value.trim();

      if (!name || !email || !password || !confirmPassword) {
        alert("All fields are required.");
        return false;
      }

      if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
      }

      if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }

      alert("Signup successful (demo only)");
      // Normally you'd send this data to the server
    };
  }

  // Forgot Password Form
  if (forgotForm) {
    forgotForm.onsubmit = function (e) {
      e.preventDefault();

      const email = document.getElementsByName("email")[0].value.trim();

      if (email === "") {
        alert("Please enter your email address.");
        return false;
      }

      alert("Reset link sent (demo only)");
      // Normally you'd send the email to backend to process reset
    };
  }
};
