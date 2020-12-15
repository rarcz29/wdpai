<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class ProjectController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    public function newProject()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $title = $_POST['title'];
            $description = $_POST['description'];
            $img = $_FILES['file']['name'];
            $tool = $_POST["gitTool"];
            $visibility = $_POST["visibility"];

            echo $tool;
            die();

            $project = new Project($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            return $this->render('home', ['messages' => $this->message]);
        }

        return $this->render('new-project', ['messages' => $this->message]);
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