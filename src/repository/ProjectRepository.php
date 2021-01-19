<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Project.php';

class ProjectRepository extends Repository
{
    public function addProject(Project $project, int $userId, int $gitToolId, array $technologyArr): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO projects (id_users, id_git_tools, title, description,
                image, private, created_at, origin_url, repo_name)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            RETURNING id
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

        $output = $stmt->fetch(PDO::FETCH_ASSOC);
        $projectId = $output['id'];

        if (!empty($technologyArr))
        {
            $insert = '';

            foreach ($technologyArr as $technology)
            {
                $insert = $insert.' ('.$projectId.', '.$technology.'),';
            }

            $insert = substr($insert, 0, -1);

            $stmt = $this->database->connect()->prepare('
                INSERT INTO projects_technologies (id_projects, id_technologies)
                VALUES'.$insert
            );

            $stmt->execute();
        }
    }

    public function getProjects(int $userId, string $searchString = ''): ?array
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT p.title,
                p.image as image_path,
                p.id,
                p.origin_url,
                g.name as git_tool
            FROM projects p
            LEFT JOIN git_tools g
                ON p.id_git_tools = g.id
            LEFT JOIN users_projects up
                ON up.id_projects = p.id
            WHERE p.id_users = :userId
                OR up.id_users = :userId
                AND (LOWER(p.title)
                LIKE :search
                OR LOWER(p.description)
                LIKE :search)
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProjects()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM vw_projects_details
        ');

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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