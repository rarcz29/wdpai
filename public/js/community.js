document.addEventListener("DOMContentLoaded", () => {
    getAllProjects();
});

function getAllProjects() {
    const container = document.getElementById("projects-container");

    fetch("allProjects")
        .then((response) => response.json())
        .then((data) => {
            if (Object.keys(data).length !== 0) {
                const template = document.querySelector("#project-template");

                Object.entries(data).forEach((entry) => {
                    const [key, value] = entry;
                    const clone = template.content.cloneNode(true);
                    element.appendChild(clone);
                    container.appendChild(element);
                });
            }
        });
}
