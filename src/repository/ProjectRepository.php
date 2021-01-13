<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Project.php';

class ProjectRepository extends Repository
{
    public function addProject(Project $project, int $userId, int $gitToolId): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO projects (id_users, id_git_tools, title, description,
                image, private, created_at, origin_url, repo_name)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $userId,
            $gitToolId,
            $project->getTitle(),
            $project->getDescription(),
            $project->getImage(),
            $project->isPrivate() ? 1 : 0,
            $date->format('Y-m-d'),
            $project->getOriginUrl(),
            $project->getRepoName()
        ]);
    }

    public function getProjects(int $userId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT p.*, g.name as git_name,
                COUNT(c.id) as number_of_comments
            FROM projects p
            LEFT JOIN git_tools g
                ON p.id_git_tools = g.id
            LEFT JOIN comments c
                ON c.id_projects = p.id
            WHERE
                p.id_users = :userId
            GROUP BY p.id, g.id
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($projects == false)
        {
            return null;
        }

        $array = null;

        foreach ($projects as $project)
        {
            $currentProject = new Project(
                $project['title'],
                $project['description'],
                $project['image'],
                $project['git_name'],
                $project['private'],
                $project['likes'],
                $project['dislikes'],
                $project['number_of_comments'],
                $project['id']
            );

            $currentProject->setOriginUrl($project['origin_url']);
            $array[] = $currentProject;
        }

        return $array;
    }

    public function like(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE projects SET "likes" = "likes" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function dislike(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE projects SET "dislikes" = "dislikes" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}