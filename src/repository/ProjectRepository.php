<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Project.php';

class ProjectRepository extends Repository
{
    public function addProject(Project $project): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO projects (id_users, id_git_tools, title, description, image, created_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 2;
        $gitToolId = 1;

        $stmt->execute([
            $assignedById,
            $gitToolId,
            $project->getTitle(),
            $project->getDescription(),
            $project->getImage(),
            $date->format('Y-m-d')
        ]);
    }

    public function getProjects(string $userNickname): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT p.*, g.name as git_name,
                COUNT(c.id) as number_of_comments
            FROM projects p
            LEFT JOIN git_tools g
                ON p.id_git_tools = g.id
            LEFT JOIN users u
                ON p.id_users = u.id
            LEFT JOIN comments c
                ON c.id_projects = p.id
            WHERE
                nickname = :userNickname
            GROUP BY p.id, g.id
        ');

        $stmt->bindParam(':userNickname', $userNickname, PDO::PARAM_STR);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($projects == false)
        {
            return null;
        }

        $array = null;

        // TODO: add visibility to the database
        foreach ($projects as $project)
        {
            $array[] = new Project(
                $project['title'],
                $project['description'],
                $project['image'],
                $project['git_name'],
                true,
                $project['likes'],
                $project['dislikes'],
                "null",
                $project['number_of_comments'],
                $project['id']
            );
        }

        return $array;
    }

    public function like(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE projects SET "likes" = "likes" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':item', $item, PDO::PARAM_STR);
        //$stmt->bindParam(':item', $item, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function dislike(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE projects SET "dislikes" = "dislikes" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':item', $item, PDO::PARAM_STR);
        //$stmt->bindParam(':item', $item, PDO::PARAM_STR);
        $stmt->execute();
    }
}