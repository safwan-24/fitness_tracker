<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Fitness Tracker</title>
    <link rel="stylesheet" href="../assets/styles/admin.css">
</head>
<body>
    <nav class="admin-nav">
        <div class="nav-logo">Fitness Tracker</div>
        <div class="nav-user">
            <span>Admin Dashboard</span>
            <button onclick="logout()" class="logout-btn">Logout</button>
        </div>
    </nav>

    <div class="admin-container">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <p>Manage your Fitness Tracker application</p>
        </div>
        
        <div class="admin-stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="stat-value">1,248</div>
                <p>+12% from last month</p>
            </div>
            
            <div class="stat-card">
                <h3>Workouts Logged</h3>
                <div class="stat-value">5,672</div>
                <p>This month</p>
            </div>
        </div>
        
        <div class="admin-sections">
            <div class="admin-section">
                <h2>User Management</h2>
                <ul class="admin-list">
                    <li><a href="#"><span class="icon">👥</span> View All Users</a></li>
                    <li><a href="#"><span class="icon">➕</span> Create New User</a></li>
                    <li><a href="#"><span class="icon">🔍</span> Search Users</a></li>
                    <li><a href="#"><span class="icon">🛑</span> Ban/Unban Users</a></li>
                    <li><a href="#"><span class="icon">📊</span> User Analytics</a></li>
                </ul>
            </div>
            
            <div class="admin-section">
                <h2>Content Management</h2>
                <ul class="admin-list">
                    <li><a href="#"><span class="icon">💪</span> Manage Exercises</a></li>
                    <li><a href="#"><span class="icon">📝</span> Manage Workouts</a></li>
                    <li><a href="#"><span class="icon">🍎</span> Nutrition Database</a></li>
                    <li><a href="#"><span class="icon">🏆</span> Challenges & Goals</a></li>
                </ul>
                
                <div class="recent-activity">
                    <h3>Recent Activity</h3>
                    <div class="activity-item">
                        <div class="activity-icon">👤</div>
                        <div class="activity-details">
                            <h4>New user registered</h4>
                            <p>john.doe@example.com</p>
                        </div>
                        <div class="activity-time">2 min ago</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">💪</div>
                        <div class="activity-details">
                            <h4>Workout completed</h4>
                            <p>Full Body Workout by user123</p>
                        </div>
                        <div class="activity-time">15 min ago</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
//        document.addEventListener('DOMContentLoaded', function() {
//     // Check if admin is logged in
//     if (sessionStorage.getItem('adminLoggedIn') !== 'true') {
//         window.location.href = 'admin-login.html';
//     }

//     // Logout functionality
//     document.getElementById('logoutBtn').addEventListener('click', function() {
//         sessionStorage.removeItem('adminLoggedIn');
//         window.location.href = 'admin-login.html';
//     });
// });
    </script>
</body>
</html>