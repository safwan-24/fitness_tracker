document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const navButtons = document.querySelectorAll('.nav-btn');
    const screens = document.querySelectorAll('.screen');
    const goalForm = document.getElementById('goal-form');
    const goalsList = document.getElementById('goals-list');
    const trophiesContainer = document.getElementById('trophies-container');
    
    // Navigation between screens
    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and screens
            navButtons.forEach(btn => btn.classList.remove('active'));
            screens.forEach(screen => screen.classList.remove('active'));
            
            // Add active class to clicked button and corresponding screen
            this.classList.add('active');
            const screenId = this.getAttribute('data-screen');
            document.getElementById(screenId).classList.add('active');
        });
    });
    
    // Form validation and submission
    goalForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset error messages
        clearErrors();
        
        // Validate form
        if (validateForm()) {
            // Create new goal
            const newGoal = {
                id: Date.now().toString(),
                title: document.getElementById('goal-title').value,
                type: document.getElementById('goal-type').value,
                targetValue: parseFloat(document.getElementById('target-value').value),
                unit: document.getElementById('target-unit').value,
                targetDate: document.getElementById('target-date').value,
                currentValue: 0,
                completed: false,
                completionDate: null,
                createdAt: new Date().toISOString()
            };
            
            // Save goal to localStorage
            saveGoal(newGoal);
            
            // Update UI
            addGoalToUI(newGoal);
            
            // Reset form
            goalForm.reset();
            
            // Switch to Progress Tracker
            document.querySelector('.nav-btn[data-screen="tracker"]').click();
        }
    });
    
    // Load goals when page loads
    loadGoals();
    
    // Form validation function
    function validateForm() {
        let isValid = true;
        
        // Validate title
        const titleInput = document.getElementById('goal-title');
        if (!titleInput.value.trim()) {
            showError(titleInput, 'Goal title is required');
            isValid = false;
        }
        
        // Validate type
        const typeInput = document.getElementById('goal-type');
        if (!typeInput.value) {
            showError(typeInput, 'Please select a goal type');
            isValid = false;
        }
        
        // Validate target value
        const valueInput = document.getElementById('target-value');
        if (!valueInput.value || isNaN(valueInput.value) || parseFloat(valueInput.value) <= 0) {
            showError(valueInput, 'Please enter a valid positive number');
            isValid = false;
        }
        
        // Validate unit
        const unitInput = document.getElementById('target-unit');
        if (!unitInput.value) {
            showError(unitInput, 'Please select a unit');
            isValid = false;
        }
        
        // Validate date
        const dateInput = document.getElementById('target-date');
        if (!dateInput.value) {
            showError(dateInput, 'Please select a target date');
            isValid = false;
        } else {
            const selectedDate = new Date(dateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                showError(dateInput, 'Target date must be in the future');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    // Show error message
    function showError(input, message) {
        const formGroup = input.parentElement;
        const errorMessage = formGroup.querySelector('.error-message');
        input.style.borderColor = 'var(--danger-color)';
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
    }
    
    // Clear all error messages
    function clearErrors() {
        document.querySelectorAll('.form-group input, .form-group select').forEach(input => {
            input.style.borderColor = '#ddd';
            const errorMessage = input.parentElement.querySelector('.error-message');
            errorMessage.textContent = '';
            errorMessage.style.display = 'none';
        });
    }
    
    // Save goal to localStorage
    function saveGoal(goal) {
        const goals = getGoals();
        goals.push(goal);
        localStorage.setItem('goals', JSON.stringify(goals));
    }
    
    // Get all goals from localStorage
    function getGoals() {
        return JSON.parse(localStorage.getItem('goals')) || [];
    }
    
    // Load goals and display them
    function loadGoals() {
        const goals = getGoals();
        
        // Clear existing goals in UI
        goalsList.innerHTML = '';
        trophiesContainer.innerHTML = '';
        
        if (goals.length === 0) {
            goalsList.innerHTML = '<p class="empty-message">No goals yet. Create one to get started!</p>';
            trophiesContainer.innerHTML = '<p class="empty-message">No completed goals yet. Keep working!</p>';
            return;
        }
        
        // Separate completed and incomplete goals
        const incompleteGoals = goals.filter(goal => !goal.completed);
        const completedGoals = goals.filter(goal => goal.completed);
        
        // Display incomplete goals in Progress Tracker
        if (incompleteGoals.length > 0) {
            incompleteGoals.forEach(goal => addGoalToUI(goal));
        } else {
            goalsList.innerHTML = '<p class="empty-message">All goals completed! Create a new one.</p>';
        }
        
        // Display completed goals in Celebration screen
        if (completedGoals.length > 0) {
            completedGoals.forEach(goal => addTrophyToUI(goal));
        } else {
            trophiesContainer.innerHTML = '<p class="empty-message">No completed goals yet. Keep working!</p>';
        }
    }
    
    // Add goal to Progress Tracker UI
    function addGoalToUI(goal) {
        // Remove empty message if it exists
        const emptyMessage = goalsList.querySelector('.empty-message');
        if (emptyMessage) {
            emptyMessage.remove();
        }
        
        // Calculate progress percentage
        const progressPercentage = (goal.currentValue / goal.targetValue) * 100;
        const cappedProgress = Math.min(progressPercentage, 100);
        
        // Create goal card
        const goalCard = document.createElement('div');
        goalCard.className = 'goal-card';
        goalCard.setAttribute('data-id', goal.id);
        goalCard.innerHTML = `
            <div class="goal-header">
                <h3 class="goal-title">${goal.title}</h3>
                <span class="goal-type">${goal.type}</span>
            </div>
            <p class="goal-target">Target: ${goal.targetValue} ${goal.unit} by ${formatDate(goal.targetDate)}</p>
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: ${cappedProgress}%"></div>
                </div>
                <div class="progress-text">
                    <span>${goal.currentValue} ${goal.unit}</span>
                    <span>${cappedProgress.toFixed(1)}%</span>
                </div>
            </div>
            <div class="goal-actions">
                <button class="action-btn update-btn" data-action="update">Update Progress</button>
                <button class="action-btn complete-btn" data-action="complete">Mark Complete</button>
                <button class="action-btn delete-btn" data-action="delete">Delete</button>
            </div>
        `;
        
        goalsList.appendChild(goalCard);
        
        // Add event listeners to action buttons
        addGoalActionListeners(goalCard, goal);
    }
    
    // Add trophy to Celebration UI
    function addTrophyToUI(goal) {
        // Remove empty message if it exists
        const emptyMessage = trophiesContainer.querySelector('.empty-message');
        if (emptyMessage) {
            emptyMessage.remove();
        }
        
        // Create trophy card
        const trophyCard = document.createElement('div');
        trophyCard.className = 'trophy-card';
        trophyCard.innerHTML = `
            <div class="trophy-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h3 class="trophy-title">${goal.title}</h3>
            <p class="trophy-date">Completed on ${formatDate(goal.completionDate)}</p>
            <p>Achieved: ${goal.targetValue} ${goal.unit}</p>
        `;
        
        trophiesContainer.appendChild(trophyCard);
    }
    
    // Add event listeners to goal action buttons
    function addGoalActionListeners(goalCard, goal) {
        const actionButtons = goalCard.querySelectorAll('.action-btn');
        
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                
                switch (action) {
                    case 'update':
                        updateGoalProgress(goal);
                        break;
                    case 'complete':
                        completeGoal(goal.id);
                        break;
                    case 'delete':
                        deleteGoal(goal.id);
                        break;
                }
            });
        });
    }
    
    // Update goal progress
    function updateGoalProgress(goal) {
        const newValue = prompt(`Enter current progress for "${goal.title}" (in ${goal.unit}):`, goal.currentValue);
        
        if (newValue !== null && !isNaN(newValue)) {
            const updatedValue = parseFloat(newValue);
            
            // Update goal in localStorage
            const goals = getGoals();
            const goalIndex = goals.findIndex(g => g.id === goal.id);
            
            if (goalIndex !== -1) {
                goals[goalIndex].currentValue = updatedValue;
                localStorage.setItem('goals', JSON.stringify(goals));
                
                // Reload goals to update UI
                loadGoals();
            }
        }
    }
    
    // Mark goal as complete
    function completeGoal(goalId) {
        if (confirm('Mark this goal as completed?')) {
            // Update goal in localStorage
            const goals = getGoals();
            const goalIndex = goals.findIndex(g => g.id === goalId);
            
            if (goalIndex !== -1) {
                goals[goalIndex].completed = true;
                goals[goalIndex].completionDate = new Date().toISOString();
                goals[goalIndex].currentValue = goals[goalIndex].targetValue;
                localStorage.setItem('goals', JSON.stringify(goals));
                
                // Reload goals to update UI
                loadGoals();
                
                // Switch to Celebration screen
                document.querySelector('.nav-btn[data-screen="celebration"]').click();
            }
        }
    }
    
    // Delete goal
    function deleteGoal(goalId) {
        if (confirm('Are you sure you want to delete this goal?')) {
            // Remove goal from localStorage
            const goals = getGoals().filter(goal => goal.id !== goalId);
            localStorage.setItem('goals', JSON.stringify(goals));
            
            // Reload goals to update UI
            loadGoals();
        }
    }
    
    // Format date for display
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString(undefined, options);
    }
});