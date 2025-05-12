document.getElementById("dateForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);

    fetch("set_start_time.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("dateMsg").textContent = data;
        document.getElementById("dateMsg").style.color = "green";
    })
    .catch(err => {
        document.getElementById("dateMsg").textContent = "Error saving date.";
        document.getElementById("dateMsg").style.color = "red";
    });
});
