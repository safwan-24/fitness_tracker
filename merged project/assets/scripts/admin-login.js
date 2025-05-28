document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('adminLoginForm');
    const emailInput = document.getElementById('admin-email');
    const passwordInput = document.getElementById('admin-password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');

    const ADMIN_CREDENTIALS = {
        email: "admin@gmail.com",
        password: "admin1234"
    };

 
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        const email = emailInput.value.trim();
        if (!email) {
            showError(emailError, 'Email is required');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError(emailError, 'Please enter a valid email');
            isValid = false;
        } else {
            clearError(emailError);
        }

        const password = passwordInput.value.trim();
        if (!password) {
            showError(passwordError, 'Password is required');
            isValid = false;
        } else {
            clearError(passwordError);
        }

        if (isValid) {
            if (email === ADMIN_CREDENTIALS.email && password === ADMIN_CREDENTIALS.password) {
                sessionStorage.setItem('adminLoggedIn', 'true');
                window.location.href = 'admin-dashboard.html';
            } else {
                showError(passwordError, 'Invalid email or password');
            }
        }
    });

    function showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
    }

    function clearError(element) {
        element.textContent = '';
        element.style.display = 'none';
    }
});