const search = document.querySelector('input[placeholder="Technologies..."]');
const chooseTechnologyContainer = document.querySelector(".choose-technology");
let timeout = null;

search.addEventListener("keyup", () => {
    clearTimeout(timeout);
    const value = search.value;
    const data = { search: search.value };

    if (value) {
        timeout = setTimeout(() => getData(data), 200);
    } else {
        chooseTechnologyContainer.innerHTML = "";
    }
});

function getData(data) {
    fetch("/searchTechnologies", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((data) => {
            chooseTechnologyContainer.innerHTML = "";
            loadTechnologies(data);
        });
}

function loadTechnologies(data) {
    data.forEach((technology) => {
        createTechnology(technology);
    });
}

function createTechnology(technology) {
    const template = document.querySelector("#technology-template");
    const clone = template.content.cloneNode(true);
    const description = clone.querySelector("p");
    description.innerHTML = technology.description;
    chooseTechnologyContainer.appendChild(clone);
}
