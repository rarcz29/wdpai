<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
//        $stmt = $this->database->connect()->prepare('
//            SELECT * FROM users u LEFT JOIN users_details ud
//            ON u.id_users_details = ud.id WHERE email = :email
//        ');
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
            $user['nickname'],
            $user['email'],
            $user['password']
//            $user['name'],
//            $user['surname']
        );
    }

    public function addUser(User $user)
    {
//        $stmt = $this->database->connect()->prepare('
//            INSERT INTO users_details (name, surname, phone)
//            VALUES (?, ?, ?)
//        ');
//
//        $stmt->execute([
//            $user->getName(),
//            $user->getSurname(),
//            $user->getPhone()
//        ]);

//        $stmt = $this->database->connect()->prepare('
//            INSERT INTO users (email, password, id_user_details)
//            VALUES (?, ?, ?)
//        ');
//
//        $stmt->execute([
//            $user->getEmail(),
//            $user->getPassword(),
//            $this->getUserDetailsId($user)
//        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (nickname, email, password)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getNickname(),
            $user->getEmail(),
            $user->getPassword(),
            //$this->getUserDetailsId($user)
        ]);
    }
}