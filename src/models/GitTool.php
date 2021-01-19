<?php

class GitTool
{
    private $id;
    private $name;
    private $login;
    private $token;

    public function __construct($id, $name, $login, $token)
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->token = $token;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): string
    {
        $this->name = $name;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login): string
    {
        $this->login = $login;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token): string
    {
        $this->token = $token;
    }
}