const inputImgUpload = document.getElementById("input-img-upload");
const textarea = document.querySelector("textarea");
textarea.addEventListener("keydown", autosize);
inputImgUpload.addEventListener("change", updateImgUpladPath);

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
