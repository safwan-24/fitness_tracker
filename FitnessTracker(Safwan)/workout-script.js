// Initialize drag-and-drop
document.addEventListener('DOMContentLoaded', () => {
    const draggables = document.querySelectorAll('.draggable');
  
    draggables.forEach(draggable => {
      draggable.addEventListener('dragstart', (e) => {
        e.dataTransfer.setData('text/plain', e.target.textContent);
      });
    });
  });
  
  function generateWeeks(numWeeks) {
    const weeksContainer = document.getElementById('weeksContainer');
    weeksContainer.innerHTML = '';
  
    for (let i = 1; i <= numWeeks; i++) {
      const week = document.createElement('div');
      week.className = 'week';
      week.innerHTML = `<h4>Week ${i}</h4>`;
  
      const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      const daysGrid = document.createElement('div');
      daysGrid.className = 'days';
  
      days.forEach(day => {
        const dayBox = document.createElement('div');
        dayBox.className = 'day';
        dayBox.innerHTML = `<strong>${day}</strong>`;
        dayBox.addEventListener('dragover', e => e.preventDefault());
        dayBox.addEventListener('drop', e => {
          e.preventDefault();
          const text = e.dataTransfer.getData('text/plain');
          const newItem = document.createElement('div');
          newItem.className = 'draggable';
          newItem.draggable = true;
          newItem.textContent = text;
  
          // Allow redrag
          newItem.addEventListener('dragstart', e => {
            e.dataTransfer.setData('text/plain', e.target.textContent);
          });
  
          dayBox.appendChild(newItem);
        });
        daysGrid.appendChild(dayBox);
      });
  
      week.appendChild(daysGrid);
      weeksContainer.appendChild(week);
    }
  }
  
  function savePlan() {
    const weeks = document.querySelectorAll('.week');
    const plan = [];
  
    weeks.forEach((week, index) => {
      const weekData = { week: index + 1, days: [] };
      const dayBoxes = week.querySelectorAll('.day');
  
      dayBoxes.forEach(dayBox => {
        const dayName = dayBox.querySelector('strong').textContent;
        const workouts = Array.from(dayBox.querySelectorAll('.draggable')).map(el => el.textContent);
        weekData.days.push({ day: dayName, workouts });
      });
  
      plan.push(weekData);
    });
  
    console.log('Saved Workout Plan:', plan);
    alert('Workout Plan saved successfully! Check the console for saved data.');
  }
  