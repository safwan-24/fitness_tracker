
document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault(); 

    const form = e.target;
    const formData = new FormData(form);

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();
    const notRobot = document.getElementById("notRobot").checked;
    const errorElem = document.getElementById("formError");

    if (!notRobot) {
        errorElem.textContent = "Please confirm you're not a robot.";
        return;
    }

    if (name === "" || email === "" || message === "") {
        errorElem.textContent = "Please fill in all required fields.";
        return;
    }

    fetch("../controller/contact_submit.php", {
        method: "POST",
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest' 
        }
    })
    .then(res => res.json()) 
    .then(data => {
        const msgBox = document.createElement('p');
        msgBox.textContent = data.message;
        msgBox.style.color = data.success ? "green" : "red";
        msgBox.style.textAlign = "center";

        const existing = document.querySelector('.form-cell p');
        if (existing) existing.remove();

        
        document.querySelector('.form-cell').appendChild(msgBox);

        if (data.success) {
            alert("Your message has been submitted successfully!");
            form.reset(); 
        }
    })
    .catch(error => {
        alert("An error occurred: " + error);
        console.error("Error:", error);
    });
});

