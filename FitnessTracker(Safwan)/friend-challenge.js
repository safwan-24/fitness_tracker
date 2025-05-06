// Leaderboard Data (Simulated)
const leaderboardData = [
    { name: 'Alex', score: 8500, progress: 85 },
    { name: 'Taylor', score: 7200, progress: 72 },
    { name: 'Jordan', score: 6300, progress: 63 }
  ];
  
  // DOM Loaded
  document.addEventListener('DOMContentLoaded', () => {
    populateLeaderboard();
  });
  
  // Create Challenge
  function createChallenge() {
    const name = document.getElementById('challengeName').value;
    const type = document.getElementById('challengeType').value;
    const target = document.getElementById('challengeTarget').value;
  
    if (!name || !target) {
      alert('Please fill all fields!');
      return;
    }
  
    alert(`Challenge "${name}" created!\nType: ${type}\nTarget: ${target}`);
    document.getElementById('challengeName').value = '';
    document.getElementById('challengeTarget').value = '';
  }
  
  // Populate Leaderboard
  function populateLeaderboard() {
    const list = document.getElementById('leaderboardList');
    list.innerHTML = '';
  
    leaderboardData.sort((a, b) => b.score - a.score).forEach((user, index) => {
      const li = document.createElement('li');
      li.innerHTML = `
        <strong>${index + 1}. ${user.name}</strong>
        <span>${user.score} ${type === 'steps' ? 'steps' : 'workouts'}</span>
        <div class="progress-bar" style="width: ${user.progress}%"></div>
      `;
      list.appendChild(li);
    });
  }
  
  // Send Cheer
  function sendCheer() {
    const user = document.getElementById('userSelect').value;
    const msg = document.getElementById('cheerMsg').value;
  
    if (!msg) {
      alert('Write a cheer message!');
      return;
    }
  
    const feed = document.getElementById('cheerFeed');
    const cheerElement = document.createElement('p');
    cheerElement.innerHTML = `
      <span class="cheer-user">You → ${user}:</span> 
      "${msg}"
    `;
    feed.prepend(cheerElement);
    document.getElementById('cheerMsg').value = '';
  }