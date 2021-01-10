<?php

require_once __DIR__.'/Cookies.php';
require_once __DIR__.'/Session.php';

// TODO: add session to the database
class User
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

    public function isLoggedIn()
    {
        return Cookies::getNickname() !== null;
    }
}