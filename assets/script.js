function loadInbox() {
    let q = document.getElementById("search").value;
    fetch("api.php?q=" + q)
    .then(res => res.json())
    .then(data => {
        let box = document.getElementById("inbox");
        box.innerHTML = "";

        if (data.length === 0) {
            box.innerHTML = "<p>No mails found.</p>";
            return;
        }

        data.forEach(m => {
            box.innerHTML += `
                <div class="mail" onclick="openMail('${m.id}', '${m.sender}', '${m.subject}', \`${m.message}\`)">
                    <b>${m.subject}</b>
                    <small>${m.sender}</small>
                </div>
            `;
        });
    });
}

function copyEmail() {
    let e = document.getElementById("email");
    e.select();
    navigator.clipboard.writeText(e.value);
    alert("Copied!");
}

function openMail(id, sender, subject, msg) {
    let p = document.createElement("div");
    p.className = "popup";
    p.innerHTML = `
        <div class="popup-box">
            <h3>${subject}</h3>
            <small>From: ${sender}</small>
            <p>${msg}</p>

            <button onclick="deleteMail(${id}, this)">Delete</button>
            <button onclick="this.parentElement.parentElement.remove()">Close</button>
        </div>
    `;
    document.body.appendChild(p);
}

function deleteMail(id, btn) {
    fetch("actions.php?action=delete", {
        method: "POST",
        body: new URLSearchParams({ id })
    });
    alert("Mail deleted.");
    btn.parentElement.parentElement.remove();
    loadInbox();
}

function downloadInbox() {
    window.location = "actions.php?action=download";
}

function toggleTheme() {
    document.body.classList.toggle("dark");
}
