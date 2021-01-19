<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Project.php';
require_once __DIR__.'/../repository/ProjectRepository.php';
require_once __DIR__.'/../repository/GitToolRepository.php';
require_once __DIR__.'/../repository/TechnologyRepository.php';
require_once __DIR__.'/../services/curl/GitHub.php';
require_once __DIR__.'/../services/curl/GitLab.php';

class ProjectController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $projectRepository;
    private $gitToolRepository;
    private $technologyRepository;

    public function __construct()
    {
        parent::__construct();
        $this->projectRepository = new ProjectRepository();
        $this->gitToolRepository = new GitToolRepository();
        $this->technologyRepository = new TechnologyRepository();
    }

    // TODO: check if repository exists
    public function newProject()
    {
        if (!$this->account->isLoggedIn())
        {
            $this->redirect();
        }

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) &&
            $this->validate($_FILES['file']))
        {
            move_uploaded_file
            (
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $title = $_POST['title'];
            $description = $_POST['description'];
            $img = $_FILES['file']['name'];
            $tool = $_POST["gitTool"];
            $private = $_POST["visibility"] === 'private';
            $technologies = $_POST['technologies'];

            $gitTool = $this->gitToolRepository->getGitTool($this->account->getUserId(), $tool);
            $repo = null;

            // API
            switch ($tool)
            {
                case 'github':
                    $repo = new GitHub();
                    break;

                case 'bitbucket':
                    break;

                case 'gitlab':
                    $repo = new GitLab();
                    break;
            }

            $project = $repo->createNewRepository($gitTool->getLogin(), $gitTool->getToken(),
                $title, $description, $private);

            if ($project === null)
            {
                // TODO: message
                $this->render('newProject');
            }

            // Database
            $project->setImage($img);
            $this->projectRepository->addProject($project, $this->account->getUserId(), $gitTool->getId(), $technologies);
            $this->redirect('home');
        }

        return $this->render('newProject', ['messages' => $this->message]);
    }

    public function projects()
    {
        if (!$this->account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            $json = json_encode($response);
            echo $json;
        }

        echo json_encode($this->projectRepository->getProjects($this->account->getUserId()));
    }

    public function projectsAll()
    {
        if (!$this->account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            echo json_encode($response);
            return;
        }

        $output = $this->projectRepository->getAllProjects();
        $output['technologies'] = json_decode($output['technologies']);
        echo json_encode($output);
    }

    public function like(int $id) {
        $this->projectRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->projectRepository->dislike($id);
        http_response_code(200);
    }

    public function searchTechnologies()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->technologyRepository->getTechnologyByName($decoded['search']));
        }
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->projectRepository->getProjects($this->account->getUserId(), $decoded['search']));
        }
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE)
        {
            // TODO: messages
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES))
        {
            $this->message[] = 'File type is not supported.';
            return false;
        }

        return true;
    }
}