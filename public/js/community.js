document.addEventListener("DOMContentLoaded", () => {
    getAllProjects();
});

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

                    container.appendChild(clone);
                });
            }
        });
}
