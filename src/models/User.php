<?php

require_once 'UserRoles.php';

class User
{
    private $id;
    private $nickname;
    private $email;
    private $password;
    private $userRoles;

    public function __construct(string $id, string $nickname, string $email, string $password)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getUserRoles(): ?UserRoles
    {
        return $this->userRoles;
    }

    public function setUserRoles(UserRoles $userRoles): void
    {
        $this->userRoles = $userRoles;
    }
}