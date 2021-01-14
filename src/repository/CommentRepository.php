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

    public function addComment(int $projectId, int $userId, string $text, string $userName): ?Comment
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO comments (id_projects, id_users, text, date)
            VALUES (?, ?, ?, ?)
            RETURNING id
        ');

        $stmt->execute([
            $projectId,
            $userId,
            $text,
            $date->format('Y-m-d'),
        ]);

        $output = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $output['id'];
        return $id === null
            ? null
            : new Comment($id, $userName, $text, $date->format('Y-m-d'));
    }

    public function removeComment(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM comments WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}