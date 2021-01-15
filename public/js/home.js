const form = document.getElementById("git-tools-form");
form.addEventListener("submit", logSubmit);

document.addEventListener("DOMContentLoaded", () => {
    checkConnection();
    getProjects();
    getRequests();
});

function logSubmit(event) {
    const formattedData = new FormData(form);

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
            const title = clone.querySelector("h1");
            const git = clone.querySelector("p");
            link.href = value.url;
            title.innerHTML = value.title;
            git.innerHTML = value.git_tool;
            element.appendChild(clone);
            container.appendChild(element);
        });
    }
}

function getRequests() {
    fetch("joinRequests")
        .then((response) => response.json())
        .then((data) => {
            displayRequests(data);
        });
}

function displayRequests(data) {
    const container = document.querySelector(".home-news-container");

    if (!data.message) {
        const template = document.querySelector("#notification-template");
        Object.values(data).forEach((value) => {
            const clone = template.content.cloneNode(true);
            const username = clone.querySelector("h1");
            const projectName = clone.querySelector(".request-info > p > span");
            username.parentElement.parentElement.id = value.id;
            username.innerHTML = value.username;
            projectName.innerHTML = value.title;
            container.appendChild(clone);
        });

        requestButtons(container);
    } else {
        showEmptyImage();
    }
}

function showEmptyImage() {
    const image = document.querySelector("#news-empty-image");

    if (image) {
        image.style.display = "block";
    }
}

function requestButtons(container) {
    const acceptButtons = container.querySelectorAll(".bt-green");
    const declineButtons = container.querySelectorAll(".bt-red");

    acceptButtons.forEach((button) =>
        button.addEventListener("click", acceptRequest)
    );
    declineButtons.forEach((button) =>
        button.addEventListener("click", declineRequest)
    );
}

function acceptRequest() {
    const button = this;
    const container = button.parentElement.parentElement;
    fetch(`/accept/${container.id}`);
    container.remove();
}

function declineRequest() {
    const button = this;
    const container = button.parentElement.parentElement;
    fetch(`/decline/${container.id}`);
    container.remove();
}
