function loginUser() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    alert(`Login attempted with\nEmail: ${email}\nPassword: ${password}`);
    // Add authentication logic here
  }
  
  function registerUser() {
    const name = document.getElementById('signupName').value;
    const email = document.getElementById('signupEmail').value;
    const password = document.getElementById('signupPassword').value;
    const confirm = document.getElementById('signupConfirmPassword').value;
    if (password !== confirm) {
      alert("Passwords do not match.");
      return;
    }
    alert(`Registering:\nName: ${name}\nEmail: ${email}`);
    // Add registration logic and email verification trigger here
  }
  
  function sendResetLink() {
    const email = document.getElementById('forgotEmail').value;
    alert(`Reset link sent to: ${email}`);
    // Add email reset logic here
  }
  
  function resetPassword() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    if (newPassword !== confirmPassword) {
      alert("Passwords do not match.");
      return;
    }
    alert("Password has been reset.");
    // Add password update logic here
  }
  
  // Note: Actual backend implementation is required for full functionality.