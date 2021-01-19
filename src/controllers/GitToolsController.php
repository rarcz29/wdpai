<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/GitTool.php';
require_once __DIR__.'/../repository/GitToolRepository.php';
require_once __DIR__.'/../services/Account.php';

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
        if (!$this->account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            $json = json_encode($response);
            echo $json;
            return;
        }

        $response = null;

        if (!$this->isPost())
        {
            $response = array(
                "tool" => "unknown",
                "value" => false
            );
        }
        else
        {
            $userId = $this->account->getUserId();
            $gitTool = $_POST['gitTool'];
            $login = $_POST['login'];
            $token = $_POST['token'];
            $tool = null;


            switch ($gitTool) {
                case "github":
                    $tool = new GitHub();
                    break;

                case "gitlab":
                    $tool = new GitLab();
                    break;

                default:
                    $response = array(
                        "message" => "This git tool doesn't exists"
                    );
                    $json = json_encode($response);
                    echo $json;
                    return;
            }

            $headers = $tool->setHeaders($login, $token);
            $gitAccountName = $tool->getUsername($headers, $login);
            $exists = $gitAccountName === $login;
            $response = array(
                "tool" => $gitTool,
                "value" => $exists
            );

            if ($exists)
            {
                $model = new GitTool(0, $gitTool, $login, $token);
                $this->gitToolRepository->addUserGitTool($userId, $model);
            }
        }

        $json = json_encode($response);
        echo $json;
    }

    public function getConnectedTools()
    {
        if (!$this->account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            $json = json_encode($response);
            echo $json;
        }

        $array = $this->gitToolRepository->getGitTools($this->account->getUserId());
        $toolName1 = "github";
        $toolName2 = "bitbucket";
        $toolName3 = "gitlab";

        $response = array(
            $toolName1 => false,
            $toolName2 => false,
            $toolName3 => false
        );

        foreach ($array as $item)
        {
            switch ($item->getName())
            {
                case $toolName1:
                    $response[$toolName1] = true;
                    break;

                case $toolName2:
                    $response[$toolName2] = true;
                    break;

                case $toolName3:
                    $response[$toolName3] = true;
                    break;
            }
        }

        $json = json_encode($response);
        echo $json;
    }
}