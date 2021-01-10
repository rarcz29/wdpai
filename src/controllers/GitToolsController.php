<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/GitTool.php';
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
        $account = new Account();
        if (!$account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            $json = json_encode($response);
            echo $json;
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
            $nickname = $account->getUserName();
            $gitTool = $_POST['gitTool'];
            $login = $_POST['login'];
            $token = $_POST['token'];
            $exists = false;
            $nodeId = null;

            switch ($gitTool) {
                case "github":
                    $tool = new GitHub();
                    $gitAccountName = $tool->getUsername($token);
                    $exists = $gitAccountName === $login;
                    $response = array(
                        "tool" => $gitTool,
                        "value" => $exists
                    );
                    break;
            }

            if ($exists)
            {
                $model = new GitTool($gitTool, $login, $token);
                $this->gitToolRepository->addUserGitTool($nickname, $model);
            }
        }

        $json = json_encode($response);
        echo $json;
    }

    public function getConnectedTools()
    {
        $account = new Account();
        if (!$account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            $json = json_encode($response);
            echo $json;
        }

        $array = $this->gitToolRepository->getGitTools($account->getUserId());
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