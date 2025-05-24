const ctx = document.getElementById('progressChart').getContext('2d');

const progressChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [
      {
        label: 'Bench Press (kg)',
        data: [60, 65, 70, 75],
        borderColor: 'rgba(255, 99, 132, 1)',
        fill: false,
        tension: 0.3
      },
      {
        label: '5K Run Time (min)',
        data: [30, 28, 27, 26],
        borderColor: 'rgba(54, 162, 235, 1)',
        fill: false,
        tension: 0.3
      }
    ]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: false
      }
    }
  }
});
