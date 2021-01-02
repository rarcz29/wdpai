<?php

class GitTool
{
    private $name;
    private $login;
    private $token;
    private $nodeId;

    public function __construct($name, $login, $token, $nodeId)
    {
        $this->name = $name;
        $this->login = $login;
        $this->token = $token;
        $this->nodeId = $nodeId;
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

    public function getNodeId()
    {
        return $this->nodeId;
    }

    public function setNodeId($nodeId): void
    {
        $this->nodeId = $nodeId;
    }
}