const exercises = [
    { name: 'Push-up', equipment: 'Bodyweight', bodyPart: 'Chest' },
    { name: 'Deadlift', equipment: 'Barbell', bodyPart: 'Back' },
    { name: 'Bicep Curl', equipment: 'Dumbbell', bodyPart: 'Arms' },
    { name: 'Leg Press', equipment: 'Machine', bodyPart: 'Legs' }
  ];
  
  const searchInput = document.getElementById('search');
  const exerciseList = document.getElementById('exercise-list');
  
  function displayExercises(list) {
    exerciseList.innerHTML = '';
    list.forEach(ex => {
      const card = document.createElement('div');
      card.className = 'exercise-card';
      card.innerHTML = `<h3>${ex.name}</h3><p><strong>Equipment:</strong> ${ex.equipment}</p><p><strong>Body Part:</strong> ${ex.bodyPart}</p>`;
      exerciseList.appendChild(card);
    });
  }
  
  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    const filtered = exercises.filter(ex =>
      ex.name.toLowerCase().includes(query) ||
      ex.equipment.toLowerCase().includes(query) ||
      ex.bodyPart.toLowerCase().includes(query)
    );
    displayExercises(filtered);
  });
  
  displayExercises(exercises);
  