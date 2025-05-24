
document.getElementById('workoutForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const program = document.getElementById('program').value;
  const goal = document.getElementById('goal').value;
  const startDate = document.getElementById('startDate').value;

  const details = `
    Duration: ${program} weeks<br>
    Goal: ${goal.replace('_', ' ')}<br>
    Start Date: ${new Date(startDate).toDateString()}
  `;

  document.getElementById('programDetails').innerHTML = details;
  document.getElementById('confirmation').classList.remove('hidden');
});

    // Display username
    const user = localStorage.getItem("user");
    if (user) {
      document.getElementById("username").textContent = `Welcome, ${user}`;
    }
    
    // Program selection
    function selectProgram(level) {
      document.querySelectorAll('.program-btn').forEach(btn => {
        btn.classList.remove('active');
      });
      event.target.classList.add('active');
      
      // In a real app, this would load different workout templates
      console.log(`Selected ${level} program`);
    }
    
    // Drag and drop functionality
    document.addEventListener('DOMContentLoaded', () => {
      const exerciseItems = document.querySelectorAll('.exercise-item');
      const dropzones = document.querySelectorAll('.exercise-dropzone');
      
      // Make exercises draggable
      exerciseItems.forEach(item => {
        item.addEventListener('dragstart', dragStart);
      });
      
      // Set up drop zones
      dropzones.forEach(zone => {
        zone.addEventListener('dragover', dragOver);
        zone.addEventListener('dragleave', dragLeave);
        zone.addEventListener('drop', drop);
      });
    });
    
    let draggedItem = null;
    
    function dragStart() {
      draggedItem = this;
      setTimeout(() => {
        this.style.opacity = '0.4';
      }, 0);
    }
    
    function dragOver(e) {
      e.preventDefault();
      this.classList.add('highlight');
    }
    
    function dragLeave() {
      this.classList.remove('highlight');
    }
    
    function drop(e) {
      e.preventDefault();
      this.classList.remove('highlight');
      
      if (draggedItem) {
        const clonedItem = draggedItem.cloneNode(true);
        clonedItem.style.opacity = '1';
        clonedItem.draggable = false;
        
        // Add exercise controls
        const exerciseControls = document.createElement('div');
        exerciseControls.className = 'exercise-actions';
        exerciseControls.innerHTML = `
          <button onclick="removeExercise(this)">✕</button>
          <button onclick="editExercise(this)">✏️</button>
        `;
        
        clonedItem.appendChild(exerciseControls);
        this.appendChild(clonedItem);
      }
    }
    
    // Exercise actions
    function removeExercise(button) {
      button.closest('.exercise-item').remove();
    }
    
    function editExercise(button) {
      const exercise = button.closest('.exercise-item');
      const exerciseName = exercise.querySelector('.exercise-name').textContent;
      const newName = prompt("Edit exercise name:", exerciseName);
      
      if (newName) {
        exercise.querySelector('.exercise-name').textContent = newName;
      }
    }
    
    // Week tab switching
    document.querySelectorAll('.week-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        document.querySelectorAll('.week-tab').forEach(t => {
          t.classList.remove('active');
        });
        this.classList.add('active');
        // In a real app, this would load the selected week's plan
      });
    });
    
    // Category filtering
    document.querySelectorAll('.category-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.category-btn').forEach(b => {
          b.classList.remove('active');
        });
        this.classList.add('active');
        // In a real app, this would filter exercises by category
      });
    });
    
    function logout() {
      localStorage.removeItem("user");
      window.location.href = "login.php";
    }

