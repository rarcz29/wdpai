// const search = document.querySelector("#search-project");
// const projectContainer = document.querySelector(".projects");

// search.addEventListener("keyup", (event) => {
//     if (event.key === "Enter") {
//         event.preventDefault();

//         const data = { search: this.value };

//         fetch("/search", {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//             },
//             body: JSON.stringify(data),
//         })
//             .then((response) => response.json())
//             .then((projects) => {
//                 projectContainer.innerHTML = "";
//                 loadProjects(projects);
//             });
//     }
// });

// function loadProjects(projects) {
//     projects.forEach((project) => {
//         console.log(project);
//         createProject(project);
//     });
// }

// function createProject(project) {
//     const shared = document.querySelector("#project-shared");

//     const clone = shared.content.cloneNode(true);
//     const div = clone.querySelector("div");
//     div.id = project.id;
//     const image = clone.querySelector("img");
//     image.src = `/public/uploads/${project.image}`;
//     const title = clone.querySelector("h2");
//     title.innerHTML = project.title;
//     const description = clone.querySelector("p");
//     description.innerHTML = project.description;
//     const like = clone.querySelector(".fa-heart");
//     like.innerText = project.like;
//     const dislike = clone.querySelector(".fa-minus-square");
//     dislike.innerText = project.dislike;

//     projectContainer.appendChild(clone);
// }
