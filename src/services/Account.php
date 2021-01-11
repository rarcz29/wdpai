<?php

require_once __DIR__.'/Cookies.php';
require_once __DIR__.'/Session.php';
require_once __DIR__.'/../repository/UserRolesRepository.php';
require_once __DIR__.'/../models/UserRoles.php';

// TODO: add session to the database
class Account
{
    public function logIn(int $id, string $username)
    {
        Cookies::setNicknameCookie($username);
        Session::setUserId($id);
        $rolesRepo = new UserRolesRepository();
        $roles = $rolesRepo->getRoles();
        Session::setAdminPrivileges($roles->isAdmin());
        Session::setModeratorPrivileges($roles->isModerator());
    }

    public function logOut()
    {
        Cookies::deleteCookies();
        Session::unsetAll();
    }

    public function isLoggedIn(): bool
    {
        return Cookies::getNickname() !== null &&
            Session::getUserId() !== null &&
            Session::isAdmin() !== null &&
            Session::isModerator() !== null;
    }

    public function getUserId(): ?int
    {
        $this->logOutIfNoData();
        return Session::getUserId();
    }

    public function getUserName(): ?string
    {
        $this->logOutIfNoData();
        return Cookies::getNickname();
    }

    public function extendUserSessionLife()
    {
        if ($this->isLoggedIn())
        {
            Cookies::setNicknameCookie(Cookies::getNickname());
        }
        else
        {
            $this->logOut;
        }
    }

    private function logOutIfNoData()
    {
        if (!$this->isLoggedIn())
        {
            $this->logOut();
        }
    }
}