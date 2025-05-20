
  // Check if user is logged in
  const user = localStorage.getItem("user");
  if (!user) {
    window.location.href = "login.html";
  } else {
    document.getElementById("username").innerText = `Welcome, ${user}`;
  }

  function logout() {
    localStorage.removeItem("user");
    window.location.href = "login.html";
  }
