<?php
    session_start();
    $_SESSION['lang'] = "en";
    //$LANG = "en";

    switch ($_SERVER['REQUEST_URI']) {
        case "":
        case "/login":
            $_SESSION['state'] = "login";
            $_SESSION['title'] = "Login";
//            $CURRENT_PAGE = "Login";
//            $PAGE_TITLE = "Login";
            break;
        case "/signup":
            $_SESSION['state'] = "signup";
            $_SESSION['title'] = "Register";
//            $CURRENT_PAGE = "Signup";
//            $PAGE_TITLE = "Register";
            break;
        case "/home":
            $_SESSION['state'] = "home";
            $_SESSION['title'] = "CNode | Home";
//            $CURRENT_PAGE = "Home";
//            $PAGE_TITLE = "CNode";
            break;
        case "/newProject":
            $_SESSION['state'] = "new-project";
            $_SESSION['title'] = "CNone | New Project";
//            $CURRENT_PAGE = "New Project";
//            $PAGE_TITLE = "Create New Project";
            break;
    }