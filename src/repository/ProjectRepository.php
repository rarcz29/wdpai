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
            SELECT p.*, g.*
            FROM projects p
            LEFT JOIN git_tools g
                ON p.id_git_tools = g.id
            LEFT JOIN users u
                ON ug.id_user = u.id
            WHERE
                nickname = :userNickname
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
                $project['name'],
                true
            );
        }

        return $array;
    }
}