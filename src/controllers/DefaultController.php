<?php

require_once 'AppController.php';
require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        $this->render('login');
    }

    public function signup()
    {
        $this->render('signup');
    }

    public function home()
    {
        // TODO: cookies
        if (Cookies::getNickname() === null)
        {
            return $this->render("login");
        }

        $this->render('home');
    }

    public function community()
    {
        $this->render('community');
    }
}
