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

        $nickname = $_COOKIE['user_name'];
        $login = $_POST['login'];
        $password = md5($_POST['password']);
        $token = $_POST['token'];

        $myArr = array(
            "tool"=>"GitHub",
            "value"=>true,
        );
        $json = json_encode($myArr);

        echo $json;
        die();

//        if (!$user)
//        {
//            return $this->render('login', ['messages' => ['User not found!']]);
//        }
//
//        if ($user->getEmail() !== $email)
//        {
//            return $this->render('login', ['messages' => ['User not exist!']]);
//        }
//
//        if ($user->getPassword() !== $password)
//        {
//            return $this->render('login', ['messages' => ['Wrong password!']]);
//        }
//
//        return $this->render('home');
    }
}