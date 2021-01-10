<?php

require_once __DIR__.'/Cookies.php';
require_once __DIR__.'/Session.php';

// TODO: add session to the database
class Account
{
    public function logIn(int $id, string $username)
    {
        Cookies::setNicknameCookie($username);
        Session::setUserId($id);
    }

    public function logOut()
    {
        Cookies::deleteCookies();
    }

    public function isLoggedIn(): bool
    {
        return Cookies::getNickname() !== null;
    }

    public function getUserId(): ?int
    {
        return Session::getUserId();
    }

    public function getUserName(): ?string
    {
        return Cookies::getNickname();
    }
}