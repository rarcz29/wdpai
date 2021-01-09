document.addEventListener("DOMContentLoaded", () => {
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
    const container = document.getElementById("projects-container");
    const emptyContainerText = document.getElementById("no-projects-info");

    fetch("projects")
        .then((response) => response.json())
        .then((data) => {
            if (Object.keys(data).length === 0) {
                emptyContainerText.style.display = "block";
            } else {
                const template = document.querySelector(
                    "#project-tile-template"
                );

                Object.entries(data).forEach((entry) => {
                    const [key, value] = entry;
                    let element = document.createElement("li");
                    const clone = template.content.cloneNode(true);
                    element.appendChild(clone);
                    container.appendChild(element);
                });
            }
        });
}
