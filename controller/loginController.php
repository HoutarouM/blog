<?php

namespace App\Controller;

class LoginController extends BasicController
{
    protected function login($login, $pass)
    {
        // hash password
        // and execute model method register
        // if user with this username and password exists
        // create a session and redirect to main page
        // else view message

        $pass = hash('sha512', $_POST['pass']);

        $res = $this->model->login($login, $pass);

        if ($res) {
            $_SESSION['login'] = $login;

            header('location: index.php');
        } else {
            echo 'Wrong login or password.';
        }
    }
};
