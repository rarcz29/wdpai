function deleteCommenta() {
    console.log("remove");
    const button = this;
    const comment = button.parentElement;
    const id = comment.id;
    fetch(`/removeComment/${id}`).then(comment.remove());

    const numberOfComments = document.querySelector(
        ".social-section .comments > p"
    );

    numberOfComments.innerHTML = parseInt(numberOfComments.innerHTML) - 1;
}
