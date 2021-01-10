<?php

class Session
{
    private const ID = "user_id";

    public static function setUserId(int $id)
    {
        $_SESSION[self::ID] = $id;
    }

    public static function getUserId(): ?int
    {
        return $_SESSION[self::ID];
    }

    public static function unsetUserId()
    {
        unset($_SESSION[self::ID]);
    }
}