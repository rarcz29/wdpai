var textarea = document.querySelector("textarea");
textarea.addEventListener("keydown", autosize);

function autosize() {
  var el = this;

  setTimeout(() => {
    el.style.cssText = "height: auto; padding: 1em;";
    el.style.cssText = "height: calc(" + el.scrollHeight + "px + 1px);";
  }, 0);
}
