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
            $nickname = Cookies::getNickname();
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
    }

    public function getConnectedTools()
    {
        $array = $this->gitToolRepository->getGitTools(Cookies::getNickname());
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