<?php

namespace App\Controller;

class LogoutController extends BasicController
{
    public function index($url, $data = [])
    {
        $_SESSION['login'] = '';

        session_destroy();

        header('Location: index.php');
    }
};
