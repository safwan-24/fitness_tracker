
document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault(); // পেজ রিফ্রেশ হওয়া বন্ধ করে

    const form = e.target;
    const formData = new FormData(form);

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();
    const notRobot = document.getElementById("notRobot").checked;
    const errorElem = document.getElementById("formError");

    // পুরাতন এরর রিসেট
    errorElem.textContent = "";

    // Check if "I'm not a robot" checkbox is checked
    if (!notRobot) {
        errorElem.textContent = "Please confirm you're not a robot.";
        return;
    }

    // ফর্ম ফিল্ড ভ্যালিডেশন
    if (name === "" || email === "" || message === "") {
        errorElem.textContent = "Please fill in all required fields.";
        return;
    }

    // AJAX call
    fetch("../controller/contact_submit.php", {
        method: "POST",
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // জানায় এটি AJAX রিকোয়েস্ট
        }
    })
    .then(res => res.json()) // JSON রেসপন্স কনভার্ট করে
    .then(data => {
        const msgBox = document.createElement('p');
        msgBox.textContent = data.message;
        msgBox.style.color = data.success ? "green" : "red";
        msgBox.style.textAlign = "center";

        // আগের যেকোনো মেসেজ থাকলে রিমুভ করে
        const existing = document.querySelector('.form-cell p');
        if (existing) existing.remove();

        // মেসেজ দেখাও
        document.querySelector('.form-cell').appendChild(msgBox);

        if (data.success) {
            alert("Your message has been submitted successfully!");
            form.reset(); // ফর্ম রিসেট
        }
    })
    .catch(error => {
        alert("An error occurred: " + error);
        console.error("Error:", error);
    });
});

