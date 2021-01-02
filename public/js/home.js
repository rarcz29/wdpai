const form = document.getElementById("git-tools-form");
form.addEventListener("submit", logSubmit);
document.addEventListener("DOMContentLoaded", loadData);

function logSubmit(event) {
    const formattedData = new FormData(form);
    //formattedFormData.append("property", "value");

    fetch("gitToolConnect", { method: "POST", body: formattedData })
        .then((response) => response.json())
        .then((data) => {
            if (data.tool !== "unknown" && data.value === true) {
                const toolConnectedIcon = document.getElementById(
                    data.tool + "-connected-icon"
                );
                toolConnectedIcon.style.opacity = "1";
            } else {
                alert("Connection failure!");
            }

            form.reset();
        });

    event.preventDefault();
}

function loadData() {
    fetch("gitToolConnect")
        .then((response) => response.text())
        .then((data) => {
            console.log(data);
        });
}
