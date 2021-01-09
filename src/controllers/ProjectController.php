<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Project.php';
require_once __DIR__ . '/../services/Cookies.php';
require_once __DIR__.'/../repository/ProjectRepository.php';
require_once __DIR__.'/../services/curl/GitHub.php';

class ProjectController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $projectRepository;
    private $gitToolRepository;

    public function __construct()
    {
        parent::__construct();
        $this->projectRepository = new ProjectRepository();
        $this->gitToolRepository = new GitToolRepository();
    }

    // TODO: check if repository exists
    public function newProject()
    {
        if (Cookies::getNickname() === null)
        {
            return $this->render("login");
        }

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
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
            $visibility = $_POST["visibility"];
            $private = $visibility === "private";
            $userNickname = Cookies::getNickname();

            $gitTool = $this->gitToolRepository->getGitTool($userNickname, $tool);

            // API
            $tool = new GitHub();
            // TODO: check if it's correct
            $response = $tool->createNewRepository($userNickname, $gitTool->getToken(),
                $title, $description, $private);
            // Database
            $project = new Project($title, $description, $img, $tool, $visibility);
            $this->projectRepository->addProject($project);
            return $this->render('home', ['messages' => $this->message]);
        }

        return $this->render('newProject', ['messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE)
        {
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