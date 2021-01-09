export function getProjects() {
    console.log("joł");
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
