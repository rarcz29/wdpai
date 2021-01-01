<?php

class GitTool
{
    private $name;
    private $password;
    private $login;
    private $token;

    public function __construct($name, $password, $login, $token)
    {
        $this->name = $name;
        $this->password = $password;
        $this->login = $login;
        $this->token = $token;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): string
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): string
    {
        $this->password = $password;
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