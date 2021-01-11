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

    public function addUser(User $user)
    {
        // users table
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (nickname, email, password)
            VALUES (?, ?, ?)
            RETURNING id
        ');

        $stmt->execute([
            $user->getNickname(),
            $user->getEmail(),
            $user->getPassword(),
        ]);

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        // users_roles table
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_roles (nickname, email, password)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getNickname(),
            $user->getEmail(),
            $user->getPassword(),
        ]);
    }

    private
}