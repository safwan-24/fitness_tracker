<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Goal Settings | Fitness Tracker</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
    <link rel="stylesheet" href="../assets/styles/goalsettings.css" />


</head>
<body>
    <div class="app-container">
        <header>
            <h1>Goal Setting App</h1>
            <nav>
                <button class="nav-btn active" data-screen="creator">Goal Creator</button>
                
            </nav>
        </header>

        <main>
            <!-- Goal Creator Screen -->
            <div id="creator" class="screen active">
                <h2>Set a New Goal</h2>
                <div id="debug-info" style="display:none;">
                    <p>Session Email: <?php echo $_SESSION['email'] ?? 'Not set'; ?></p>
                </div>
                <form id="goal-form" onsubmit="return false;">
                    <div class="form-group">
                        <label for="goal-title">Goal Title</label>
                        <input type="text" id="goal-title" name="title" placeholder="e.g., Run 5K" required>
                        <small class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="goal-type">Goal Type</label>
                        <select id="goal-type" name="type" required>
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
                        <input type="number" id="target-value" name="targetValue" placeholder="e.g., 5 (for 5K or 5lbs)" required>
                        <small class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="target-unit">Unit</label>
                        <select id="target-unit" name="unit" required>
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
                        <input type="date" id="target-date" name="targetDate" required>
                        <small class="error-message"></small>
                    </div>
                    
                    <button type="submit" class="btn" onclick="document.getElementById('debug-info').style.display='block';">Create Goal</button>
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

        </main>
    </div>

    <script>
        window.onerror = function(msg, url, line) {
            console.error(`Error: ${msg}\nURL: ${url}\nLine: ${line}`);
            return false;
        };
    </script>
    <script src="../assets/scripts/goalsettings.js"></script>
</body>
</html>