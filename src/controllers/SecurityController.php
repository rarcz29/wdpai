<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->account->logOut();
    }

    public function login()
    {
        if (!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $user = $this->userRepository->getUser($email);

        if (!$user)
        {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email)
        {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getPassword() !== $password)
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        // TODO: important!
        $this->account->logIn($user->getId(), $user->getNickname());
        $this->redirect('home');
    }

    public function register()
    {
        if (!$this->isPost())
        {
            return $this->render('register');
        }

        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        if ($password !== $confirmedPassword)
        {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        //TODO try to use better hash function
        $user = new User(0, $nickname, $email, md5($password));
        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }
}