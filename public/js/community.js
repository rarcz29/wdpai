//const likeButton = document.querySelector("img");

document.addEventListener("DOMContentLoaded", () => {
    getAllProjects();
});

// TODO: move code to separate functions
function getAllProjects() {
    const container = document.querySelector(".projects-container");

    fetch("projects")
        .then((response) => response.json())
        .then((data) => {
            if (Object.keys(data).length !== 0) {
                const template = document.querySelector("#project-template");

                Object.entries(data).forEach((entry) => {
                    const [key, value] = entry;
                    const clone = template.content.cloneNode(true);

                    const basicInfo = clone.querySelector(".basic-info");
                    const title = basicInfo.querySelector("h2");
                    title.innerText = value.title;
                    const description = basicInfo.querySelector("p");
                    description.innerText = value.description;

                    const likes = clone.querySelector(".thumbs-up");
                    likes.innerText = value.likes;
                    const dislikes = clone.querySelector(".thumbs-down");
                    dislikes.innerText = value.dislikes;

                    const commentsSection = clone.querySelector(".comments");
                    const comments = commentsSection.querySelector("p");
                    comments.innerText = value.numberOfComments;

                    clone.querySelector("article").id = value.id;
                    container.appendChild(clone);

                    likesListener();
                });
            }
        });
}

function likesListener() {
    const likeButtons = document.querySelectorAll(".fa-thumbs-up");
    const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");

    likeButtons.forEach((button) => button.addEventListener("click", giveLike));
    dislikeButtons.forEach((button) =>
        button.addEventListener("click", giveDislike)
    );
}

function giveLike() {
    const likes = this;
    const container =
        likes.parentElement.parentElement.parentElement.parentElement
            .parentElement;
    const id = container.getAttribute("id");
    console.log(id);

    fetch(`/like/${id}`)
        .then((response) => response.text())
        .then((x) => {
            console.log(x);
            //likes.innerHTML = parseInt(likes.innerHTML) + 1;
        });
}

function giveDislike() {
    const dislikes = this;
    const container =
        dislikes.parentElement.parentElement.parentElement.parentElement
            .parentElement;
    const id = container.getAttribute("id");
    console.log(id);

    fetch(`/dislike/${id}`).then((response) => {
        console.log(response);
        //dislikes.innerHTML = parseInt(dislikes.innerHTML) + 1;
    });
}
