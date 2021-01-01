<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/GitTool.php';
require_once __DIR__.'/../repository/GitToolRepository.php';

class GitToolsController extends AppController
{
    private $gitToolRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gitToolRepository = new GitToolRepository();
    }

    public function gitToolConnect()
    {
        if (!$this->isPost())
        {
            echo "ELLOL";
            die();
        }

        $login = $_POST['login'];
        $password = md5($_POST['password']);
        $token = $_POST['token'];

        if (!$user)
        {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email)
        {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getPassword() !== $password)
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('home');
    }
}