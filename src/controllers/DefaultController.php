<?php

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
        echo $this->account->isAdmin();
        echo $this->account->isModerator();
        die();

        if (!$this->account->isLoggedIn())
        {
            $this->redirect();
        }

        $this->render('home');
    }

    public function community()
    {
        if (!$this->account->isLoggedIn())
        {
            $this->redirect();
        }

        $this->render('community');
    }
}
