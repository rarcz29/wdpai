<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Project.php';
require_once __DIR__.'/../repository/ProjectRepository.php';

class ProjectRestApiController extends AppController
{
    private $projectRepository;

    public function __construct()
    {
        parent::__construct();
        $this->projectRepository = new projectRepository();
    }

//    public function gitToolConnect()
//    {
//        if (!$this->isPost())
//        {
//        }
//
//        $json = json_encode($response);
//        echo $json;
//    }

    public function projects()
    {
        $array = $this->projectRepository(Cookies::getNickname());
        $json = json_encode($array);
        echo $json;
    }
}