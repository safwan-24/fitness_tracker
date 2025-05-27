document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    // Optional: Check "I'm not a robot"
    if (!document.getElementById('notRobot').checked) {
        alert("Please confirm you're not a robot.");
        return;
    }

    fetch("../controller/contact_submit.php", {
        method: "POST",
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'  // Let PHP know it's AJAX
        }
    })
    .then(res => res.json())
    .then(data => {
        const msgBox = document.createElement('p');
        msgBox.textContent = data.message;
        msgBox.style.color = data.success ? "green" : "red";
        msgBox.style.textAlign = "center";

        // Remove existing message if any
        const existing = document.querySelector('.form-cell p');
        if (existing) existing.remove();

        document.querySelector('.form-cell').appendChild(msgBox);

        if (data.success) {
            form.reset();
        }
    })
    .catch(error => {
        alert("An error occurred: " + error);
        console.error("Error:", error);
    });
});
