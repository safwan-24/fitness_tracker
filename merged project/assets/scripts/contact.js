document.getElementById("contactForm").addEventListener("submit", function (e) {

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const message = document.getElementById("message").value.trim();
  const notRobot = document.getElementById("notRobot").checked;
  const errorElem = document.getElementById("formError");

  // Reset error message
  errorElem.textContent = "";

  // Validation
  if (name === "" || email === "" || message === "") {
    errorElem.textContent = "Please fill in all required fields.";
    return;
  }

  if (!notRobot) {
    errorElem.textContent = "Please confirm you are not a robot.";
    return;
  }

  // If everything is valid
  alert("Your message has been submitted. A confirmation email has been sent.");
});
