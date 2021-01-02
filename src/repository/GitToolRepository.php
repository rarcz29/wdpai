<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/GitTool.php';

class GitToolRepository extends Repository
{
//    public function isConnected(string $name, string $userNickname): bool
//    {
//        $stmt = $this->database->connect()->prepare('
//            SELECT name
//            FROM user_git_tools ug
//            LEFT JOIN git_tools g
//                ON ug.id_git_tools = g.id
//            LEFT JOIN users u
//                ON ug.id_user = u.id
//            WHERE
//                name = :name AND
//                nickname = :userNickname
//        ');
//        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
//        $stmt->bindParam(':userNickname', $userNickname, PDO::PARAM_STR);
//        $stmt->execute();
//
//        $gitTool = $stmt->fetch(PDO::FETCH_ASSOC);
//        return $gitTool ? true : false;
//    }

    public function getGitTool(string $userNickname): ?GitTool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ug.*, g.*
            FROM user_git_tools ug
            LEFT JOIN git_tools g
                ON ug.id_git_tools = g.id
            LEFT JOIN users u
                ON ug.id_user = u.id
            WHERE
                name = :name AND
                nickname = :userNickname
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':userNickname', $userNickname, PDO::PARAM_STR);
        $stmt->execute();

        $gitTool = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gitTool == false)
        {
            return null;
        }

        return new GitTool(
            $gitTool['name'],
            $gitTool['login'],
            $gitTool['token'],
            $gitTool['node_id']
        );
    }

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

    public function getUserId(string $nickname): int
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

    public function getGitToolId(string $name): int
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