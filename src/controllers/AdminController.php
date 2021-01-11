<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/UserRolesRepository.php';

class AdminController extends AppController
{
    private $userRepository;
    private $userRolesRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->userRolesRepository = new UserRolesRepository();
    }

    public function admin()
    {
        if (!$this->account->isAdmin())
        {
            $this->redirect('home');
        }

        if ($this->isPost())
        {
            $id = $_POST['id'];
            $isAdmin = $_POST['admin'] === 'on';
            $isModerator = $_POST['moderator'] === 'on';
            $roles = new UserRoles($isAdmin, $isModerator);
            $this->userRolesRepository->updateRoles($id, $roles);
        }

        $users = $this->userRepository->getAllUsers();

        foreach ($users as $user)
        {
            $roles = $this->userRolesRepository->getRoles($user->getId());
            $user->setUserRoles($roles);
        }

        $this->render('admin', ['users' => $users]);
    }
}