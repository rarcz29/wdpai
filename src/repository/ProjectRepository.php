<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Project.php';

class ProjectRepository extends Repository
{
    public function addProject(Project $project): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO projects (id_users, id_git_tools, title, description, created_at)
            VALUES (?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 2;
        $gitToolId = 1;

        $stmt->execute([
            $assignedById,
            $gitToolId,
            $project->getTitle(),
            $project->getDescription(),
            $date->format('Y-m-d'),
        ]);
    }
}