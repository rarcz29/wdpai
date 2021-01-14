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

    public function projects()
    {
        $this->getProjects(false);
    }

    public function projectsAll()
    {
        $this->getProjects(true);
    }

    public function like(int $id) {
        $this->projectRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->projectRepository->dislike($id);
        http_response_code(200);
    }

    private function getProjects(bool $all)
    {
        if (!$this->account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            $json = json_encode($response);
            echo $json;
        }

        $array = $all
            ? $this->projectRepository->getProjects()
            : $this->projectRepository->getProjects($this->account->getUserId());
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
                    'visibility' => $element->isPrivate(),
                    'likes' => $element->getLikes(),
                    'dislikes' => $element->getDislikes(),
                    // TODO:
                    //'visibility' => $element->getComments(),
                    'numberOfComments' => $element->getNumberOfComments(),
                    'id' => $element->getId(),
                    'url' => $element->getOriginUrl()
                );
            }

            $json = json_encode($arrayOfArrays);
            echo $json;
        }
    }
}