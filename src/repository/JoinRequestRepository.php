<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/JoinRequest.php';

class JoinRequestRepository extends Repository
{
    public function getRequests(int $userId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT jr.*, p.title, u.nickname
            FROM join_requests jr
            LEFT JOIN projects p 
            ON jr.id_projects = p.id
            LEFT JOIN users u
            ON jr.id_users = u.id
            WHERE u.id = :userId
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($requests == false)
        {
            return null;
        }

        $array = null;

        foreach ($requests as $request)
        {
            $array[] = new JoinRequest($request['id'], $request['title'], $request['nickname']);
        }

        return $array;
    }

    public function addRequest(int $userId, int $projectId)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO join_requests (id_projects, id_users)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $projectId,
            $userId
        ]);
    }

    public function confirmRequest(int $requestId)
    {
        $request = $this->getRequest($requestId);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_projects (id_projects, id_users)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $request['id_projects'],
            $request['id_users']
        ]);

        $stmtRemove = $this->database->connect()->prepare('
            DELETE FROM join_requests WHERE id = :requestId
        ');

        $stmtRemove->bindParam(':requestId', $requestId, PDO::PARAM_INT);
        $stmtRemove->execute();
    }

    public function removeComment(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM comments WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function getRequest(int $requestId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM join_requests
            WHERE id = :requestId
        ');

        $stmt->bindParam(':requestId', $requestId, PDO::PARAM_INT);
        $stmt->execute();

        $request = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($request == false)
        {
            return null;
        }

        return $request;
    }
}