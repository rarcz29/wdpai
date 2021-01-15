const search = document.querySelector('input[placeholder="Technologies..."]');
const chooseTechnologyContainer = document.querySelector("main");
let timeout = null;

search.addEventListener("keyup", () => {
    clearTimeout(timeout);
    const value = search.value;
    const data = { search: search.value };

    if (value) {
        timeout = setTimeout(() => getData(data), 200);
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
        .then((response) => {
            response.text();
        })
        .then((data) => {
            console.log(data);
            // projectContainer.innerHTML = "";
            // loadTechnologies(projects);
        });
}

function loadTechnologies(data) {
    data.forEach((technology) => {
        createProject(technology);
    });
}

function createProject(technology) {
    const template = document.querySelector("#project-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = project.id;
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${project.image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = project.title;
    const description = clone.querySelector("p");
    description.innerHTML = project.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = project.like;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = project.dislike;

    chooseTechnologyContainer.appendChild(clone);
}
