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
                "message" => 'empty'
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

    public function accept(int $id)
    {
        if ($this->account->isLoggedIn())
        {
            $this->joinRequestRepository->confirmRequest($id);
            http_response_code(200);
        }
    }

    public function decline(int $id)
    {
        if ($this->account->isLoggedIn())
        {
            $this->joinRequestRepository->removeRequest($id);
            http_response_code(200);
        }
    }
}