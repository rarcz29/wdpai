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
    const lastInTheRow = getLastInTheRow(container);
    projectsContainer.insertBefore(
        commentsContainer,
        lastInTheRow.nextElementSibling
    );
    commentsContainer = projectsContainer.querySelector(".comment-section");
    commentsContainer.scrollIntoView({
        behavior: "smooth",
        block: "center",
    });

    const inputId = commentsContainer.querySelector("input[type='hidden']");
    inputId.value = id;

    commentsContainer
        .querySelector(".exit-button")
        .addEventListener("click", removeComments);

    const form = document.querySelector(".comment-section form");
    form.addEventListener("submit", (event) => addCommentSubmit(event, form));

    getComments(id);
}

function removeComments() {
    const comments = document.querySelectorAll(".comment-section");
    comments.forEach((container) => container.remove());
}

function getLastInTheRow(element) {
    let currentElement = element;

    while (
        currentElement.nextElementSibling !== null &&
        currentElement.offsetLeft < currentElement.nextElementSibling.offsetLeft
    ) {
        currentElement = currentElement.nextElementSibling;
    }

    return currentElement;
}

function getComments(id) {
    fetch(`/comments/${id}`)
        .then((response) => response.json())
        .then((data) => {
            //console.log(data);
            if (!data.message) {
                const comments = document.querySelector(
                    ".comment-section .comments"
                );
                const template = document.querySelector(
                    "#single-comment-template"
                );

                Object.entries(data).forEach((entry) => {
                    const [key, value] = entry;
                    const clone = template.content.cloneNode(true);
                    const username = clone.querySelector("h2");
                    const date = clone.querySelector("header > p");
                    const comment = clone.querySelector("div > p");
                    username.innerText = value.creator;
                    date.innerText = value.date;
                    comment.innerText = value.text;
                    comments.append(clone);
                });
            }
        });
}

function addCommentSubmit(event, form) {
    const formattedData = new FormData(form);

    fetch("comment", { method: "POST", body: formattedData })
        .then((response) => response.json())
        .then((data) => {
            if (!data.message) {
                const comments = document.querySelector(
                    ".comment-section .comments"
                );
                const template = document.querySelector(
                    "#single-comment-template"
                );

                const clone = template.content.cloneNode(true);
                const username = clone.querySelector("h2");
                const date = clone.querySelector("header > p");
                const comment = clone.querySelector("div > p");
                username.innerText = data.creator;
                date.innerText = data.date;
                comment.innerText = data.text;
                comments.prepend(clone);

                const numberOfLikes = document.querySelector(
                    ".social-section .comments > p"
                );

                numberOfLikes.innerHTML = parseInt(numberOfLikes.innerHTML) + 1;
            }

            form.reset();
        });

    event.preventDefault();
}

document.addEventListener("DOMContentLoaded", () => {
    getAllProjects();
});
