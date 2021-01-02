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
    fetch("getConnectedTools")
        .then((response) => response.json())
        .then((data) => {
            Object.entries(data).forEach((entry) => {
                const [key, value] = entry;
                const toolConnectedIcon = document.getElementById(
                    key + "-connected-icon"
                );
                if (value) {
                    toolConnectedIcon.style.opacity = "1";
                }
            });
        });
}
