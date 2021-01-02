<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/GitTool.php';

class GitToolRepository extends Repository
{
    public function getGitTools(string $userNickname): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ug.*, g.*
            FROM user_git_tools ug
            LEFT JOIN git_tools g
                ON ug.id_git_tools = g.id
            LEFT JOIN users u
                ON ug.id_user = u.id
            WHERE
                nickname = :userNickname
        ');

        $stmt->bindParam(':userNickname', $userNickname, PDO::PARAM_STR);
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
                $tool['name'],
                $tool['login'],
                $tool['token'],
                $tool['node_id']
            );
        }

        return $array;
    }

    // TODO: return bool
    public function addUserGitTool(string $nickname, GitTool $gitTool)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_git_tools (id_user, id_git_tools, login, token, node_id)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $this->getUserId($nickname),
            $this->getGitToolId($gitTool->getName()),
            $gitTool->getLogin(),
            $gitTool->getToken(),
            $gitTool->getNodeId()
        ]);
    }

    private function getUserId(string $nickname): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id
            FROM users
            WHERE nickname = :nickname
        ');
        $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
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