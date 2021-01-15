<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Comment.php';
require_once __DIR__.'/../repository/CommentRepository.php';

class CommentController extends AppController
{
    private $commentRepository;

    public function __construct()
    {
        parent::__construct();
        $this->commentRepository = new CommentRepository();
    }

    public function comment()
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

        if ($this->isPost())
        {
            $comment = $this->addComment();

            if ($comment === null)
            {
                $response = array(
                    "message" => 'Error',
                );
                $json = json_encode($response);
                echo $json;
                return;
            }

            $array = $this->createCommentArray($comment);
            $json = json_encode($array);
            echo $json;
        }
    }

    public function comments(int $id)
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

        $comments = $this->commentRepository->getComments($id);
        $array = null;

        foreach ($comments as $comment) {
            $array[] = $this->createCommentArray($comment);
        }

        echo json_encode($array);
        die();
    }

    public function removeComment(int $id)
    {
        if ($this->account->isLoggedIn())
        {
            $this->commentRepository->removeComment($id);
            http_response_code(200);
        }
    }

    private function addComment(): ?Comment
    {
        $projectId = $_POST['project-id'];
        $text = $_POST['text'];
        $userId = $this->account->getUserId();
        $userName = $this->account->getUserName();
        return $this->commentRepository->addComment($projectId, $userId, $text, $userName);
    }

    private function createCommentArray(Comment $comment): array
    {
        return array(
            'id' => $comment->getId(),
            'creator' => $comment->getCreator(),
            'text' => $comment->getText(),
            'date' => $comment->getDate()
        );
    }
}