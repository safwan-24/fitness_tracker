<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal Setting App</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <header>
            <h1>Goal Setting App</h1>
            <nav>
                <button class="nav-btn active" data-screen="creator">Goal Creator</button>
                <button class="nav-btn" data-screen="tracker">Progress Tracker</button>
                <button class="nav-btn" data-screen="celebration">Celebration</button>
            </nav>
        </header>

        <main>
            <!-- Goal Creator Screen -->
            <div id="creator" class="screen active">
                <h2>Set a New Goal</h2>
                <form id="goal-form">
                    <div class="form-group">
                        <label for="goal-title">Goal Title</label>
                        <input type="text" id="goal-title" placeholder="e.g., Run 5K" required>
                        <small class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="goal-type">Goal Type</label>
                        <select id="goal-type" required>
                            <option value="">Select a type</option>
                            <option value="fitness">Fitness</option>
                            <option value="health">Health</option>
                            <option value="learning">Learning</option>
                            <option value="career">Career</option>
                            <option value="other">Other</option>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="target-value">Target Value</label>
                        <input type="number" id="target-value" placeholder="e.g., 5 (for 5K or 5lbs)" required>
                        <small class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="target-unit">Unit</label>
                        <select id="target-unit" required>
                            <option value="">Select unit</option>
                            <option value="km">Kilometers</option>
                            <option value="miles">Miles</option>
                            <option value="lbs">Pounds</option>
                            <option value="kg">Kilograms</option>
                            <option value="days">Days</option>
                            <option value="hours">Hours</option>
                            <option value="items">Items</option>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="target-date">Target Date</label>
                        <input type="date" id="target-date" required>
                        <small class="error-message"></small>
                    </div>
                    
                    <button type="submit" class="btn">Create Goal</button>
                </form>
            </div>

            <!-- Progress Tracker Screen -->
            <div id="tracker" class="screen">
                <h2>Your Goals Progress</h2>
                <div id="goals-list">
                    <!-- Goals will be added here dynamically -->
                    <p class="empty-message">No goals yet. Create one to get started!</p>
                </div>
            </div>

            <!-- Celebration Screen -->
            <div id="celebration" class="screen">
                <h2>Your Achievements</h2>
                <div id="trophies-container">
                    <!-- Completed goals with trophies will appear here -->
                    <p class="empty-message">No completed goals yet. Keep working!</p>
                </div>
            </div>
        </main>
    </div>

    <script src="../assets/scripts/goalsettings.js"></script>
</body>
</html>