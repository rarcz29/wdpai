<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/UserRoles.php';

class UserRolesRepository extends Repository
{
    public function getRoles(int $userId): UserRoles
    {
        $stmt = $this->database->connect()->prepare('
            SELECT r.description
            FROM users_roles ur
            LEFT JOIN roles r
                ON ur.id_roles = r.id
            Where id_users = :userId
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $userRoles = new UserRoles(false, false);

        foreach ($roles as $role)
        {
            switch ($role['description'])
            {
                case 'admin':
                    $userRoles->setAdmin(true);
                    break;

                case 'moderator':
                    $userRoles->setModerator(true);
                    break;
            }
        }

        return $userRoles;
    }

    public function addRole(int $userId, string $role)
    {
        $roleId = $this->getRoleId($role);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_roles (id_users, id_roles)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $userId,
            $roleId
        ]);
    }

    private function getRoleId(string $role)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id
            FROM roles
            Where description = :role
        ');
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
}