document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("goal-form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
fetch("goalsettings-controller.php", {
    method: "POST",
    body: new FormData(form)
})
.then(res => res.text())
.then(text => {
    console.log("Raw response:", text);
    try {
        const data = JSON.parse(text);
        if (data.success) {
            alert("Goal created!");
            form.reset();
        } else {
            alert("Error: " + (data.error || "Unknown"));
        }
    } catch (e) {
        alert("Invalid JSON response from server.");
        console.error("JSON parse error", e);
    }
})
.catch(err => {
    alert("Fetch error: " + err);
});

    });
});
