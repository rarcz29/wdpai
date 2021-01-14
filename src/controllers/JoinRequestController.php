<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/JoinRequest.php';
require_once __DIR__.'/../repository/JoinRequestRepository.php';

class JoinRequestController extends AppController
{
    private $joinRequestRepository;

    public function __construct()
    {
        parent::__construct();
        $this->joinRequestRepository = new JoinRequestRepository();
    }

    public function addJoinRequest(int $projectId)
    {
        if ($this->account->isLoggedIn())
        {
            $userId = $this->account->getUserId();
            $this->joinRequestRepository->addRequest($userId, $projectId);
            http_response_code(200);
        }
        else
        {
            http_response_code(401);
        }

//        if ($this->isPost())
//        {
//            $comment = $this->addComment();
//
//            if ($comment === null)
//            {
//                $response = array(
//                    "message" => 'Error',
//                );
//                $json = json_encode($response);
//                echo $json;
//                return;
//            }
//
//            $array = $this->createCommentArray($comment);
//            $json = json_encode($array);
//            echo $json;
//        }
    }

    public function joinRequests()
    {
        if (!$this->account->isLoggedIn())
        {
            $response = array(
                "message" => 'unauthenticated',
            );
            http_response_code(401);
            $json = json_encode($response);
            echo $json;
            return;
        }

        $requests = $this->joinRequestRepository->getRequests($this->account->getUserId());
        $array = null;

        if (!$requests)
        {
            $response = array(
                "message" => 'Empty'
            );
            http_response_code(200);
            $json = json_encode($response);
            echo $json;
            return;
        }

        foreach ($requests as $request)
        {
            $array[] = array(
                'id' => $request->getId(),
                'title' => $request->getProjectName(),
                'username' => $request->getUserName()
            );
        }

        http_response_code(200);
        echo json_encode($array);
    }

//    public function removeComment(int $id)
//    {
//        if ($this->account->isLoggedIn())
//        {
//            $this->commentRepository->removeComment($id);
//            http_response_code(200);
//        }
//    }
//
//    private function addComment(): ?Comment
//    {
//        $projectId = $_POST['project-id'];
//        $text = $_POST['text'];
//        $userId = $this->account->getUserId();
//        $userName = $this->account->getUserName();
//        return $this->commentRepository->addComment($projectId, $userId, $text, $userName);
//    }
//
//    private function createCommentArray(Comment $comment): array
//    {
//        return array(
//            'id' => $comment->getId(),
//            'creator' => $comment->getCreator(),
//            'text' => $comment->getText(),
//            'date' => $comment->getDate()
//        );
//    }
}