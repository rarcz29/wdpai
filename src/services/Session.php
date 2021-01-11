<?php

class Session
{
    private const ID = "user_id";
    private const ADMIN = "admin";
    private const MODERATOR = "moderator";

    public static function setUserId(int $id)
    {
        $_SESSION[self::ID] = $id;
    }

    public static function getUserId(): ?int
    {
        return $_SESSION[self::ID];
    }

    public static function isAdmin(): ?bool
    {
        return $_SESSION[self::ADMIN];
    }

    public static function isModerator(): ?bool
    {
        return $_SESSION[self::MODERATOR];
    }

    public static function setAdminPrivileges(bool $isAdmin)
    {
        $_SESSION[self::ADMIN] = $isAdmin;
    }

    public static function setModeratorPrivileges(bool $isModerator)
    {
        $_SESSION[self::MODERATOR] = $isModerator;
    }

    public static function unsetAll()
    {
        unset($_SESSION[self::ID]);
        unset($_SESSION[self::ADMIN]);
        unset($_SESSION[self::MODERATOR]);
    }
}