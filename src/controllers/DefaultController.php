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
        $this->render('home');
    }
    
    public function new()
    {
        $this->render('new-project');
    }
}
