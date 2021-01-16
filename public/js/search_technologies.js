const search = document.querySelector('input[placeholder="Technologies..."]');
const chooseTechnologyContainer = document.querySelector(".choose-technology");
const selectedContainer = document.querySelector(".selected-technologies");
let timeout = null;

search.addEventListener("keyup", () => {
    clearTimeout(timeout);
    const value = search.value;
    const data = { search: search.value };

    if (value) {
        timeout = setTimeout(() => getData(data), 500);
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
    const button = description.parentElement;
    const addedTechnologies = selectedContainer.querySelectorAll(
        ".technology-button"
    );
    description.innerHTML = technology.description;
    button.id = technology.id;

    if (!checkIfAdded(button, addedTechnologies)) {
        chooseTechnologyContainer.appendChild(clone);
        buttonListener(button);
    }
}

function checkIfAdded(button, addedTechnologies) {
    const id = button.id;
    var techArr = Array.prototype.slice.call(addedTechnologies);

    if (addedTechnologies.length === 0) {
        return false;
    }

    return techArr.some((technology) => {
        if (id === technology.id) {
            return true;
        }
    });
}

function buttonListener(button) {
    button.addEventListener("click", () => handleButtonClick(button));
}

function handleButtonClick(button) {
    const id = button.id;
    const input = button.parentElement.parentElement.querySelector("input");
    input.value = "";
    button.remove();
    selectedContainer.appendChild(button);

    const icon = button.querySelector("i");
    icon.style.color = "red";
    button.addEventListener("click", button.remove);
}
