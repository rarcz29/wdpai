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
        $this->projectRepository = new ProjectRepository();
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
        $array = $this->projectRepository->getProjects(Cookies::getNickname());
        $arrayOfArrays = null;

        if ($array === null)
        {
            echo json_encode(array());
        }
        else {
            foreach ($array as $element) {
                $arrayOfArrays[] = array(
                    'title' => $element->getTitle(),
                    'description' => $element->getDescription(),
                    'image_path' => $element->getImage(),
                    'git_tool' => $element->getTool(),
                    'visibility' => $element->getVisibility(),
                    'likes' => $element->getLikes(),
                    'dislikes' => $element->getDislikes(),
                    // TODO:
                    //'visibility' => $element->getComments(),
                    'numberOfComments' => $element->getNumberOfComments(),
                    'id' => $element->getId()
                    // TODO: visibility as a bool value
                    // TODO: pass owner and colabolators with theirs profile images
                    // TODO: add likes and dislikes
                );
            }

            $json = json_encode($arrayOfArrays);
            echo $json;
        }
    }
}