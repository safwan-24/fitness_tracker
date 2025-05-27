document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const navButtons = document.querySelectorAll('.nav-btn');
    const screens = document.querySelectorAll('.screen');
    const goalForm = document.getElementById('goal-form');
    const goalsList = document.getElementById('goals-list');
    const trophiesContainer = document.getElementById('trophies-container');
    
    if (!goalForm) {
        console.error('Goal form not found!');
        return;
    }
    
    // Navigation between screens
    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetScreen = button.dataset.screen;
            
            // Update active button
            navButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Update active screen
            screens.forEach(screen => {
                screen.classList.remove('active');
                if (screen.id === targetScreen) {
                    screen.classList.add('active');
                }
            });
        });
    });
    
    // Form handling
    const errorMessages = document.querySelectorAll('.error-message');
    
    // Clear error messages
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(error => error.textContent = '');
    }
    
    // Validate form data
    function validateForm(formData) {
        let errors = {};
        let isValid = true;
        
        console.log('Validating form data:', formData); // Debug log
        
        // Title validation
        if (!formData.title || !formData.title.trim()) {
            errors.title = 'Goal title is required';
            isValid = false;
        }
        
        // Type validation
        if (!formData.type) {
            errors.type = 'Please select a goal type';
            isValid = false;
        }
        
        // Target value validation
        if (!formData.targetValue || isNaN(formData.targetValue)) {
            errors.targetValue = 'Please enter a valid number';
            isValid = false;
        }
        
        // Unit validation
        if (!formData.unit) {
            errors.unit = 'Please select a unit';
            isValid = false;
        }
        
        // Date validation
        if (!formData.targetDate) {
            errors.targetDate = 'Please select a target date';
            isValid = false;
        } else {
            const selectedDate = new Date(formData.targetDate);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate <= today) {
                errors.targetDate = 'Target date must be in the future';
                isValid = false;
            }
        }
        
        console.log('Validation result:', { isValid, errors }); // Debug log
        return { isValid, errors };
    }
    
    // Display errors in the form
    function displayErrors(errors) {
        clearErrors();
        Object.keys(errors).forEach(field => {
            const errorElement = document.querySelector(`#${field}`).nextElementSibling;
            if (errorElement) {
                errorElement.textContent = errors[field];
            }
        });
    }
    
    // Handle form submission
    goalForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Get form values
        const title = document.getElementById('goal-title').value.trim();
        const type = document.getElementById('goal-type').value;
        const targetValue = document.getElementById('target-value').value;
        const unit = document.getElementById('target-unit').value;
        const targetDate = document.getElementById('target-date').value;

        // Log form values
        console.log('Form Values:', {
            title, type, targetValue, unit, targetDate
        });

        // Basic validation
        if (!title || !type || !targetValue || !unit || !targetDate) {
            alert('Please fill in all fields');
            return;
        }

        // Create form data object
        const formData = {
            title: title,
            type: type,
            targetValue: parseFloat(targetValue),
            unit: unit,
            targetDate: targetDate
        };

        // Log the data being sent
        console.log('Sending data to server:', formData);

        try {
            // Show loading state
            const submitButton = goalForm.querySelector('button[type="submit"]');
            submitButton.textContent = 'Creating...';
            submitButton.disabled = true;

            // Log the request URL
            console.log('Sending request to:', '../controller/goal-handler.php');

            // Send request
            const response = await fetch('../controller/goal-handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            // Log the raw response
            console.log('Raw response:', response);

            // Parse response
            const result = await response.json();
            console.log('Server response:', result);

            // Reset button state
            submitButton.textContent = 'Create Goal';
            submitButton.disabled = false;

            if (result.success) {
                // Show success message with details
                const successMessage = `Goal created successfully!\n\nDetails:\n` +
                    `Title: ${title}\n` +
                    `Type: ${type}\n` +
                    `Target: ${targetValue} ${unit}\n` +
                    `Due Date: ${new Date(targetDate).toLocaleDateString()}`;
                
                alert(successMessage);
                
                // Reset form
                goalForm.reset();
                
                // Refresh goals list if it exists
                const goalsList = document.getElementById('goals-list');
                if (goalsList) {
                    // Add the new goal to the list
                    const goalElement = document.createElement('div');
                    goalElement.className = 'goal-card';
                    goalElement.innerHTML = `
                        <h3>${title}</h3>
                        <p>Type: ${type}</p>
                        <p>Target: ${targetValue} ${unit}</p>
                        <p>Due: ${new Date(targetDate).toLocaleDateString()}</p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 0%"></div>
                        </div>
                    `;
                    
                    // Remove empty message if it exists
                    const emptyMessage = goalsList.querySelector('.empty-message');
                    if (emptyMessage) {
                        emptyMessage.remove();
                    }
                    
                    goalsList.insertBefore(goalElement, goalsList.firstChild);
                }
            } else {
                // Show detailed error message
                let errorMessage = 'Failed to create goal:\n';
                if (result.errors && Array.isArray(result.errors)) {
                    errorMessage += result.errors.join('\n');
                } else if (result.message) {
                    errorMessage += result.message;
                } else {
                    errorMessage += 'Unknown error occurred';
                }
                alert(errorMessage);
                console.error('Server returned error:', result);
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('Error creating goal: ' + error.message);
            submitButton.textContent = 'Create Goal';
            submitButton.disabled = false;
        }
    });
    
    // Load goals when page loads
    loadGoals();
    
    // Load goals and display them
    async function loadGoals() {
        const goalsList = document.getElementById('goals-list');
        try {
            const response = await fetch('../controller/get-goals.php');
            
            if (!response.ok) {
                throw new Error(`Failed to load goals (Status: ${response.status})`);
            }
            
            const goals = await response.json();
            
            if (!Array.isArray(goals)) {
                if (goals.success === false) {
                    throw new Error(goals.message || 'Failed to load goals');
                }
                throw new Error('Invalid response from server');
            }
        
        if (goals.length === 0) {
            goalsList.innerHTML = '<p class="empty-message">No goals yet. Create one to get started!</p>';
            return;
        }
        
            goalsList.innerHTML = goals.map(goal => `
                <div class="goal-card">
                    <h3>${goal.title}</h3>
                    <p>Type: ${goal.goal_type}</p>
                    <p>Target: ${goal.target_value} ${goal.target_unit}</p>
                    <p>Due: ${new Date(goal.target_date).toLocaleDateString()}</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: ${goal.progress || 0}%"></div>
                    </div>
                </div>
            `).join('');
        } catch (error) {
            console.error('Error loading goals:', error);
            goalsList.innerHTML = '<p class="error-message">Error loading goals: ' + error.message + '</p>';
            alert('Error loading goals: ' + error.message);
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
});
