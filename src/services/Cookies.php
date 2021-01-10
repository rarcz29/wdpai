<?php

class Cookies
{
    private const USER_NAME_COOKIE = "user_name";
    private const EXPIRY_TIME = 900; // 15 min

    public static function setNicknameCookie(string $nickname)
    {
        setcookie(self::USER_NAME_COOKIE, $nickname,
            time() + self::EXPIRY_TIME, '/');
    }

    public static function deleteCookies()
    {
        setcookie(self::USER_NAME_COOKIE, $_COOKIE[self::USER_NAME_COOKIE],
            time() - self::EXPIRY_TIME * 2, '/');
    }

    public static function getNickname() : ?string
    {
        return $_COOKIE[self::USER_NAME_COOKIE];
    }
}