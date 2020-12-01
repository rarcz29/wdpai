<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User('nickname', 'jsnow@pk.edu.pl', 'admin', 'Johnny', 'Snow');

        if (!$this->isPost())
        {
            return $this->render('login');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($user->getNickname() !== $username and $user->getEmail() !== $username)
        {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getPassword() !== $password)
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('home');
    }
}