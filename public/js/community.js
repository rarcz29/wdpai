function getAllProjects() {
    const container = document.querySelector(".projects-container");

    fetch("projectsAll")
        .then((response) => response.json())
        .then((data) => {
            if (Object.keys(data).length !== 0) {
                const template = document.querySelector("#project-template");

                Object.entries(data).forEach((entry) => {
                    displayProjects(entry, template, container);
                    listener();
                });
            }
        });
}

function displayProjects(entry, template, container) {
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
    comments.innerText = value.number_of_comments;

    if (value.technologies) {
        const technologies = clone.querySelector(".details-section > p");
        let technologiesStr = value.technologies.substr(
            1,
            value.technologies.length - 2
        );
        technologiesStr = technologiesStr.replace(/,/g, ", ");
        technologies.innerHTML = technologiesStr;
    }

    clone.querySelector("article").id = value.id;
    container.appendChild(clone);
}

function listener() {
    const likeButtons = document.querySelectorAll(".fa-thumbs-up");
    const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");
    const commentsButtons = document.querySelectorAll(".fa-comments");
    const joinButtons = document.querySelectorAll(".project > .image > img");

    likeButtons.forEach((button) => button.addEventListener("click", giveLike));
    dislikeButtons.forEach((button) =>
        button.addEventListener("click", giveDislike)
    );
    commentsButtons.forEach((button) =>
        button.addEventListener("click", showComments)
    );
    joinButtons.forEach((button) =>
        button.addEventListener("click", addJoinRequest)
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
                    createComment(clone, value);
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
                createComment(clone, data);
                comments.prepend(clone);

                const numberOfComments = document.querySelector(
                    ".social-section .comments > p"
                );

                numberOfComments.innerHTML =
                    parseInt(numberOfComments.innerHTML) + 1;
            }

            form.reset();
        });

    event.preventDefault();
}

function createComment(template, data) {
    const username = template.querySelector("h2");
    const date = template.querySelector("header > p");
    const comment = template.querySelector("div > p");
    const removeButton = template.querySelector("button");
    username.innerText = data.creator;
    date.innerText = data.date;
    comment.innerText = data.text;
    username.parentElement.parentElement.id = data.id;

    removeButton !== null &&
        removeButton.addEventListener("click", deleteComment);
}

function deleteComment() {
    const button = this;
    const comment = button.parentElement;
    const id = comment.id;
    fetch(`/removeComment/${id}`).then(comment.remove());

    const numberOfComments = document.querySelector(
        ".social-section .comments > p"
    );

    numberOfComments.innerHTML = parseInt(numberOfComments.innerHTML) - 1;
}

function addJoinRequest() {
    const button = this;
    const container = button.parentElement.parentElement;
    const id = container.id;
    const text = container.querySelector(".image > h1");

    if (text.innerHTML !== "REQUESTED") {
        fetch(`/addJoinRequest/${id}`)
            .then((response) => response.text())
            .then((data) => console.log(data));
        text.innerHTML = "REQUESTED";
    }
    //
    //location.href = "home";
}

document.addEventListener("DOMContentLoaded", () => {
    getAllProjects();
});
