<?php

class Session
{
    private const ID = "user_id";

    public static function setUserId(int $id)
    {
        $_SESSION[self::ID] = $id;
    }

    public static function getNickname() : ?int
    {
        return $_SESSION[self::ID];
    }
}