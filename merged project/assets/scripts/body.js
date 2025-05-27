document.getElementById('measureForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('../controller/body.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    const msg = document.getElementById('statusMsg');
    msg.textContent = data.message;
    msg.style.color = data.success ? 'green' : 'red';
    if (data.success) {
      document.getElementById('measureForm').reset();
    }
  })
  .catch(err => {
    console.error('Error:', err);
    document.getElementById('statusMsg').textContent = 'An error occurred.';
  });
});
