<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/GitTool.php';
require_once __DIR__.'/../repository/GitToolRepository.php';
require_once __DIR__.'/../services/curl/GitHub.php';

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
            $response = array(
                "tool" => "unknown",
                "value" => false
            );
        }
        else
        {
            $nickname = $_COOKIE['user_name'];
            $gitTool = $_POST['gitTool'];
            $login = $_POST['login'];
            $token = $_POST['token'];
            $response = null;
            $exists = false;
            $nodeId = null;

            switch ($gitTool) {
                case "github":
                    $tool = new GitHub();
                    $nodeId = $tool->getNodeId($login, $token);
                    $exists = $nodeId !== null;
                    $response = array(
                        "tool" => $gitTool,
                        "value" => $exists
                    );
                    break;
            }

            if ($exists)
            {
                $model = new GitTool($gitTool, $login, $token, $nodeId);
                $this->gitToolRepository->addUserGitTool($nickname, $model);
            }

            $json = json_encode($response);
            echo $json;
        }

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