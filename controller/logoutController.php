<?php

namespace App\Controller;

class LogoutController implements BasicController
{
    protected $model;

    public function index($url, $data = [])
    {
        $_SESSION['login'] = '';

        session_destroy();

        header('Location: index.php');
    }
};
