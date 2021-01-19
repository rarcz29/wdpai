<?php

class JoinRequest
{
    private $id;
    private $projectName;
    private $userName;

    public function __construct(int $id, string $projectName, string $userName)
    {
        $this->id = $id;
        $this->projectName = $projectName;
        $this->userName = $userName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProjectName(): string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): void
    {
        $this->projectName = $projectName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }
}