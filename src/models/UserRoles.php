<?php

class UserRoles
{
    private $admin;
    private $moderator;

    public function __construct(bool $admin, bool $moderator)
    {
        $this->admin = $admin;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function setAdmin($admin): void
    {
        $this->admin = $admin;
    }

    public function isModerator(): bool
    {
        return $this->moderator;
    }

    public function setModerator($moderator): void
    {
        $this->moderator = $moderator;
    }
}