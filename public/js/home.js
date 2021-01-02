const form = document.getElementById("git-tools-form");
form.addEventListener("submit", logSubmit);

function logSubmit(event) {
    const formattedData = new FormData(form);
    //formattedFormData.append("property", "value");

    fetch("gitToolConnect", { method: "POST", body: formattedData })
        .then((response) => response.text())
        .then((data) => console.log(data));
    // .then((response) => response.json())
    // .then((data) => console.log("Created Gist:", data.html_url);
    event.preventDefault();
}
