<?php

require_once 'AppController.php';

class GitToolsController extends AppController
{
    public function gitToolConnect()
    {
        if (!$this->isPost())
        {
            echo "ELLOL";
            die();
        }

        echo $_POST['token'];
        die();
    }
}