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

                    listener();
                });
            }
        });
}

function listener() {
    const likeButtons = document.querySelectorAll(".fa-thumbs-up");
    const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");
    const commentsButtons = document.querySelectorAll(".fa-comments");

    likeButtons.forEach((button) => button.addEventListener("click", giveLike));
    dislikeButtons.forEach((button) =>
        button.addEventListener("click", giveDislike)
    );
    commentsButtons.forEach((button) =>
        button.addEventListener("click", showComments)
    );
}

function giveLike() {
    const likes = this;
    const container =
        likes.parentElement.parentElement.parentElement.parentElement
            .parentElement;
    const id = container.getAttribute("id");

    fetch(`/like/${id}`).then(() => {
        const likesContainer = likes.parentElement;
        const values = likesContainer.querySelectorAll("p");
        values[0].innerHTML = parseInt(values[0].innerHTML) + 1;
    });
}

function giveDislike() {
    const dislikes = this;
    const container =
        dislikes.parentElement.parentElement.parentElement.parentElement
            .parentElement;
    const id = container.getAttribute("id");

    fetch(`/dislike/${id}`).then(() => {
        const likesContainer = dislikes.parentElement;
        const values = likesContainer.querySelectorAll("p");
        values[1].innerHTML = parseInt(values[1].innerHTML) + 1;
    });
}

function showComments() {
    removeComments();
    const comments = this;
    const container =
        comments.parentElement.parentElement.parentElement.parentElement
            .parentElement;
    const id = container.getAttribute("id");
    const projectsContainer = container.parentElement;
    const template = document.querySelector("#comments-section-template");
    let commentsContainer = template.content.cloneNode(true);
    projectsContainer.insertBefore(commentsContainer, container.nextSibling);
    commentsContainer = projectsContainer.querySelector(".comment-section");
    commentsContainer.scrollIntoView({
        behavior: "smooth",
        block: "center",
    });
    commentsContainer
        .querySelector(".exit-button")
        .addEventListener("click", removeComments);
}

function removeComments() {
    const comments = document.querySelectorAll(".comment-section");
    comments.forEach((container) => container.remove());
}
