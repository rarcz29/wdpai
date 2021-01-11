<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AdminController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function admin()
    {
        if (!$this->account->isAdmin())
        {
            $this->redirect('home');
        }

        $users = $this->userRepository->getAllUsers();
        $this->render('admin', ['users' => $users]);
    }
}