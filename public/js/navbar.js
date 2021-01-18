const menuHandler = (menu) => {
    const className = "visible-nav";
    menu.classList.contains(className)
        ? menu.classList.remove(className)
        : menu.classList.add(className);
};

const userMenuListener = () => {
    const userList = document.querySelector(".user-list");
    const button = document.querySelector(".fa-user-circle");
    button.addEventListener("click", () => menuHandler(userList));
};

const mobileMenuListener = () => {
    const navbar = document.querySelector(".nav-container");
    const button = document.querySelector(".fa-bars");
    button.addEventListener("click", () => menuHandler(navbar));
};

const main = () => {
    userMenuListener();
    mobileMenuListener();
};

main();
