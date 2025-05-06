// Sample activity logs data
const activityLogs = [
    {
      timestamp: '2025-05-06 09:15:23',
      user: 'admin',
      action: 'login',
      details: 'User logged in successfully'
    },
    {
      timestamp: '2025-05-06 10:30:45',
      user: 'member',
      action: 'workout',
      details: 'Completed 30-minute cardio session'
    },
    {
      timestamp: '2025-05-05 14:22:33',
      user: 'admin',
      action: 'update',
      details: 'Updated system settings'
    },
    {
      timestamp: '2025-05-05 16:45:10',
      user: 'member',
      action: 'profile',
      details: 'Updated profile information'
    }
  ];
  
  // DOM elements
  const logsList = document.getElementById('logs-list');
  const dateFilter = document.getElementById('date-filter');
  const userFilter = document.getElementById('user-filter');
  const applyFiltersBtn = document.getElementById('apply-filters');
  const exportLogsBtn = document.getElementById('export-logs');
  
  // Initialize
  renderLogs(activityLogs);
  
  // Event listeners
  applyFiltersBtn.addEventListener('click', applyFilters);
  exportLogsBtn.addEventListener('click', exportLogs);
  
  // Render logs function
  function renderLogs(logs) {
    logsList.innerHTML = '';
    
    if (logs.length === 0) {
      logsList.innerHTML = '<tr><td colspan="4" style="text-align: center;">No activity logs found</td></tr>';
      return;
    }
    
    logs.forEach(log => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${log.timestamp}</td>
        <td>${log.user}</td>
        <td>${log.action}</td>
        <td>${log.details}</td>
      `;
      logsList.appendChild(row);
    });
  }
  
  // Apply filters function
  function applyFilters() {
    const dateValue = dateFilter.value;
    const userValue = userFilter.value;
    
    const filteredLogs = activityLogs.filter(log => {
      // Date filter
      if (dateValue === 'today') {
        const today = new Date().toISOString().split('T')[0];
        if (!log.timestamp.startsWith(today)) return false;
      } else if (dateValue === 'week') {
        const logDate = new Date(log.timestamp);
        const today = new Date();
        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
        if (logDate < startOfWeek) return false;
      }
      
      // User filter
      if (userValue !== 'all' && log.user !== userValue) return false;
      
      return true;
    });
    
    renderLogs(filteredLogs);
  }
  
  // Export logs function
  function exportLogs() {
    const headers = ['Timestamp', 'User', 'Action', 'Details'];
    const csvContent = [
      headers.join(','),
      ...activityLogs.map(log => 
        `${log.timestamp},${log.user},${log.action},"${log.details}"`
      )
    ].join('\n');
    
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', 'activity_logs.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }