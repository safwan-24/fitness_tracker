document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Navigation buttons
    document.getElementById('dashboardBtn').addEventListener('click', () => {
        window.location.href = 'dashboard.php';
    });
    
    document.getElementById('logoutBtn').addEventListener('click', () => {
        window.location.href = 'logout.php';
    });
    
    // Avatar change functionality
    const avatarUpload = document.getElementById('avatarUpload');
    const changeAvatarBtn = document.getElementById('changeAvatarBtn');
    const profileAvatar = document.getElementById('profileAvatar');
    const cropModal = document.getElementById('cropModal');
    const imageToCrop = document.getElementById('imageToCrop');
    const cancelCropBtn = document.getElementById('cancelCropBtn');
    const saveCropBtn = document.getElementById('saveCropBtn');
    
    changeAvatarBtn.addEventListener('click', () => {
        avatarUpload.click();
    });
    
    avatarUpload.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    imageToCrop.src = event.target.result;
                    openCropModal();
                    // Here you would initialize a cropping library like Cropper.js
                    // For this example, we'll just show the image
                };
                
                reader.readAsDataURL(file);
            }
        }
    });
    
    function openCropModal() {
        cropModal.style.display = 'flex';
    }
    
    function closeCropModal() {
        cropModal.style.display = 'none';
    }
    
    document.querySelector('.close-modal').addEventListener('click', closeCropModal);
    cancelCropBtn.addEventListener('click', closeCropModal);
    
    saveCropBtn.addEventListener('click', function() {
        // In a real implementation, this would save the cropped image
        // For this example, we'll just use the original image
        profileAvatar.src = imageToCrop.src;
        closeCropModal();
        
        // Here you would typically upload the cropped image to the server
        alert('Profile picture updated successfully!');
    });
    
    // Password strength indicator
    const newPassword = document.getElementById('newPassword');
    const strengthBars = document.querySelectorAll('.strength-bar');
    const strengthText = document.querySelector('.strength-text');
    
    newPassword.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        
        // Update strength bars
        strengthBars.forEach((bar, index) => {
            if (index < strength.level) {
                bar.style.backgroundColor = strength.color;
            } else {
                bar.style.backgroundColor = 'var(--border-color)';
            }
        });
        
        // Update strength text
        strengthText.textContent = strength.text;
        strengthText.style.color = strength.color;
    });
    
    function calculatePasswordStrength(password) {
        const strength = {
            level: 0,
            text: '',
            color: ''
        };
        
        if (password.length === 0) {
            strength.text = '';
            return strength;
        }
        
        if (password.length < 6) {
            strength.level = 1;
            strength.text = 'Weak';
            strength.color = '#ff4757';
        } else if (password.length < 10) {
            strength.level = 2;
            strength.text = 'Medium';
            strength.color = '#f39c12';
        } else {
            // Check for complexity
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);
            
            const complexity = [hasUpperCase, hasLowerCase, hasNumbers, hasSpecial].filter(Boolean).length;
            
            if (complexity < 3) {
                strength.level = 3;
                strength.text = 'Good';
                strength.color = '#2ecc71';
            } else {
                strength.level = 4;
                strength.text = 'Strong';
                strength.color = '#27ae60';
            }
        }
        
        return strength;
    }
    
    // Form submissions
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // In a real implementation, this would send data to the server
        alert('Profile updated successfully!');
        // Update view tab with new data
        document.getElementById('viewFullName').textContent = 
            `${document.getElementById('firstName').value} ${document.getElementById('lastName').value}`;
        document.getElementById('viewEmail').textContent = document.getElementById('editEmail').value;
        document.getElementById('viewGender').textContent = document.getElementById('gender').value;
        document.getElementById('viewDob').textContent = document.getElementById('dob').value;
    });
    
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (newPassword !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }
        
        // In a real implementation, this would send data to the server
        alert('Password changed successfully!');
        this.reset();
        
        // Reset strength indicator
        strengthBars.forEach(bar => {
            bar.style.backgroundColor = 'var(--border-color)';
        });
        strengthText.textContent = '';
    });
    
    // Load user data (simulated)
    function loadUserData() {
        // In a real app, this would come from an API call
        const userData = {
            firstName: 'John',
            lastName: 'Doe',
            email: 'john@example.com',
            gender: 'male',
            dob: '1990-01-01',
            joinDate: 'January 2023'
        };
        
        // Set form values
        document.getElementById('firstName').value = userData.firstName;
        document.getElementById('lastName').value = userData.lastName;
        document.getElementById('editEmail').value = userData.email;
        document.getElementById('gender').value = userData.gender;
        document.getElementById('dob').value = userData.dob;
        
        // Set view values
        document.getElementById('profileName').textContent = `${userData.firstName} ${userData.lastName}`;
        document.getElementById('profileEmail').textContent = userData.email;
        document.getElementById('viewFullName').textContent = `${userData.firstName} ${userData.lastName}`;
        document.getElementById('viewEmail').textContent = userData.email;
        document.getElementById('viewGender').textContent = userData.gender.charAt(0).toUpperCase() + userData.gender.slice(1);
        document.getElementById('viewDob').textContent = userData.dob;
        document.getElementById('viewJoinDate').textContent = userData.joinDate;
    }
    
    loadUserData();
});