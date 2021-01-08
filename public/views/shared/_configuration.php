<?php
    session_start();
    $_SESSION['lang'] = "en";

    switch ($_SERVER['REQUEST_URI']) {
        case "":
        case "/login":
            $_SESSION['state'] = "login";
            $_SESSION['title'] = "Login";
            break;
        case "/signup":
            $_SESSION['state'] = "signup";
            $_SESSION['title'] = "Register";
            break;
        case "/home":
            $_SESSION['state'] = "home";
            $_SESSION['title'] = "CNode | Home";
            break;
        case "/newProject":
            $_SESSION['state'] = "newProject";
            $_SESSION['title'] = "CNone | New Project";
            break;
    }