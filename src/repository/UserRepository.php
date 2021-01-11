<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users Where email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false)
        {
            return null;
        }

        return new User(
            $user['id'],
            $user['nickname'],
            $user['email'],
            $user['password']
        );
    }

    public function getAllUsers(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $array = null;

        foreach ($users as $user)
        {
            $array[] = new User(
                $user['id'],
                $user['nickname'],
                $user['email'],
                $user['password']
            );
        }

        return $array;
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (nickname, email, password)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getNickname(),
            $user->getEmail(),
            $user->getPassword(),
        ]);
    }
}