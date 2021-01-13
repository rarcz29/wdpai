const form = document.getElementById("git-tools-form");
form.addEventListener("submit", logSubmit);

document.addEventListener("DOMContentLoaded", () => {
    checkConnection();
    getProjects();
});

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

function checkConnection() {
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

function getProjects() {
    fetch("projects")
        .then((response) => response.json())
        .then((data) => {
            displayProjects(data);
        });
}

function displayProjects(data) {
    const container = document.getElementById("projects-container");
    const emptyContainerText = document.getElementById("no-projects-info");

    if (Object.keys(data).length === 0) {
        emptyContainerText.style.display = "block";
    } else {
        const template = document.querySelector("#project-tile-template");
        Object.entries(data).forEach((entry) => {
            const [key, value] = entry;
            const element = document.createElement("li");
            const clone = template.content.cloneNode(true);
            const link = clone.querySelector("a");
            link.href = value.url;
            element.appendChild(clone);
            container.appendChild(element);
        });
    }
}
