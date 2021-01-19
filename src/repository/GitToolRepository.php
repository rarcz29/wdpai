<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/GitTool.php';

class GitToolRepository extends Repository
{
    public function getGitTool(int $userId, string $gitToolName): ?GitTool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ug.*, g.*
            FROM user_git_tools ug
            LEFT JOIN git_tools g
                ON ug.id_git_tools = g.id
            WHERE
                name = :gitToolName AND
                ug.id_user = :userId
        ');

        $stmt->bindParam(':gitToolName', $gitToolName, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $gitTool = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gitTool == false)
        {
            return null;
        }

        return new GitTool(
            $gitTool['id'],
            $gitTool['name'],
            $gitTool['login'],
            $gitTool['token']
        );
    }

    public function getGitTools(int $userId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ug.*, g.*
            FROM user_git_tools ug
            LEFT JOIN git_tools g
                ON ug.id_git_tools = g.id
            LEFT JOIN users u
                ON ug.id_user = u.id
            WHERE
                ug.id_user = :userId
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $gitTools = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($gitTools == false)
        {
            return null;
        }

        $array = null;

        foreach ($gitTools as $tool)
        {
            $array[] = new GitTool(
                $tool['id'],
                $tool['name'],
                $tool['login'],
                $tool['token']
            );
        }

        return $array;
    }

    // TODO: return bool
    public function addUserGitTool(int $userId, GitTool $gitTool)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_git_tools (id_user, id_git_tools, login, token)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $userId,
            $this->getGitToolId($gitTool->getName()),
            $gitTool->getLogin(),
            $gitTool->getToken()
        ]);
    }

    private function getGitToolId(string $name): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id
            FROM git_tools
            WHERE name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }
}