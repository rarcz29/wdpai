<?php
//
//require_once 'AppController.php';
//require_once __DIR__ .'/../models/Project.php';
//require_once __DIR__.'/../repository/ProjectRepository.php';
//require_once __DIR__ .'/../models/Technology.php';
//require_once __DIR__.'/../repository/TechnologyRepository.php';
//
//class ProjectRestApiController extends AppController
//{
//    private $projectRepository;
//    private $technologyRepository;
//
//    public function __construct()
//    {
//        parent::__construct();
//        $this->projectRepository = new ProjectRepository();
//        $this->technologyRepository = new TechnologyRepository();
//    }
//
//    public function projects()
//    {
//        if (!$this->account->isLoggedIn())
//        {
//            $response = array(
//                "message" => 'unauthenticated',
//            );
//            $json = json_encode($response);
//            echo $json;
//        }
//
//        $array = $this->projectRepository->getProjects($this->account->getUserId());
//        $arrayOfArrays = null;
//
//        if ($array === null)
//        {
//            echo json_encode(array());
//        }
//        else {
//            foreach ($array as $element) {
//                $arrayOfArrays[] = array(
//                    'title' => $element->getTitle(),
//                    'image_path' => $element->getImage(),
//                    'git_tool' => $element->getTool(),
//                    'id' => $element->getId(),
//                    'url' => $element->getOriginUrl()
//                );
//            }
//
//            $json = json_encode($arrayOfArrays);
//            echo $json;
//        }
//    }
//
//    public function projectsAll()
//    {
//        if (!$this->account->isLoggedIn())
//        {
//            $response = array(
//                "message" => 'unauthenticated',
//            );
//            echo json_encode($response);
//            return;
//        }
//
//        $output = $this->projectRepository->getAllProjects();
//        $output['technologies'] = json_decode($output['technologies']);
//        echo json_encode($output);
//    }
//
//    public function like(int $id) {
//        $this->projectRepository->like($id);
//        http_response_code(200);
//    }
//
//    public function dislike(int $id) {
//        $this->projectRepository->dislike($id);
//        http_response_code(200);
//    }
//
//    public function searchTechnologies()
//    {
//        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
//
//        if ($contentType === "application/json")
//        {
//            $content = trim(file_get_contents("php://input"));
//            $decoded = json_decode($content, true);
//
//            header('Content-type: application/json');
//            http_response_code(200);
//
//            echo json_encode($this->technologyRepository->getTechnologyByName($decoded['search']));
//        }
//    }
//}