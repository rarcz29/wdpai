document.addEventListener("DOMContentLoaded", () => {
    getAllProjects();
});

function getAllProjects() {
    const container = document.getElementById("projects-container");

    fetch("projects")
        .then((response) => response.text())
        .then((data) => {
            console.log(data);
            // if (Object.keys(data).length !== 0) {
            //     const template = document.querySelector("#project-template");

            //     Object.entries(data).forEach((entry) => {
            //         const [key, value] = entry;
            //         const clone = template.content.cloneNode(true);
            //         element.appendChild(clone);
            //         container.appendChild(element);
            //     });
            // }
        });
}
