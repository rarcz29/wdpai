const inputImgUpload = document.getElementById("input-img-upload");
const textarea = document.querySelector("textarea");
const form = document.querySelector("form");
textarea.addEventListener("keydown", autosize);
inputImgUpload.addEventListener("change", updateImgUpladPath);
form.addEventListener("submit", submitProject);

function autosize() {
    const element = this;

    setTimeout(() => {
        element.style.cssText = "height: auto; padding: 1rem;";
        element.style.cssText =
            "height: calc(" + element.scrollHeight + "px + 1px);";
    }, 0);
}

function updateImgUpladPath() {
    const path = inputImgUpload.value;
    const visiblePath = document.getElementById("upload-img-path");
    visiblePath.innerText = path.replace(/^.*[\\\/]/, "");
}

function submitProject(event) {
    event.preventDefault();
    const formattedData = new FormData(form);
    const technologies = document.querySelectorAll(
        ".selected-technologies .technology-button"
    );

    technologies.forEach((technology) => {
        formattedData.append("technologies[]", technology.id);
    });

    fetch("newProject", { method: "POST", body: formattedData })
        .then((response) => response.text())
        .then((data) => {
            const page = document.querySelector("body");
            page.innerHTML = data;
        });
}
