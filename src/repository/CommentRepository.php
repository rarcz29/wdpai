<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Comment.php';

class CommentRepository extends Repository
{
    public function getComments(int $projectId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT c.*, u.nickname
            FROM comments c
            LEFT JOIN users u 
            ON u.id = c.id_users
            WHERE c.id_projects = :projectId
        ');

        $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $stmt->execute();

        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($comments == false)
        {
            return null;
        }

        $array = null;

        foreach ($comments as $comment)
        {
            $array[] = new Comment($comment['id'], $comment['nickname'],
                $comment['text'], $comment['date']);
        }

        return $array;
    }
}