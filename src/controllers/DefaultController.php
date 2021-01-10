<?php

require_once 'AppController.php';
require_once 'src/services/Account.php';

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
        $account = new Account();
        if (!$account->isLoggedIn())
        {
            $this->redirect();
        }

        $this->render('home');
    }

    public function community()
    {
        $account = new Account();
        if (!$account->isLoggedIn())
        {
            $this->redirect();
        }

        $this->render('community');
    }
}
