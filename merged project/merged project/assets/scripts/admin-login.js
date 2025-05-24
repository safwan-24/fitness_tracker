document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('adminLoginForm');
    const emailInput = document.getElementById('admin-email');
    const passwordInput = document.getElementById('admin-password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');

    // Admin credentials
    const ADMIN_CREDENTIALS = {
        email: "admin@gmail.com",
        password: "admin1234"
    };

    // Validate email format
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    // Form submission handler
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        // Validate email
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

        // Validate password
        const password = passwordInput.value.trim();
        if (!password) {
            showError(passwordError, 'Password is required');
            isValid = false;
        } else {
            clearError(passwordError);
        }

        // If form is valid, check credentials
        if (isValid) {
            if (email === ADMIN_CREDENTIALS.email && password === ADMIN_CREDENTIALS.password) {
                // Store login state in sessionStorage
                sessionStorage.setItem('adminLoggedIn', 'true');
                // Redirect to admin dashboard
                window.location.href = 'admin-dashboard.html';
            } else {
                showError(passwordError, 'Invalid email or password');
            }
        }
    });

    // Helper functions
    function showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
    }

    function clearError(element) {
        element.textContent = '';
        element.style.display = 'none';
    }
});