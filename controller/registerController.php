<?php

namespace App\Controller;

class RegisterController extends BasicController
{
    protected function register($login, $email, $pass, $r_pass)
    {
        // hash password
        // execute model method register
        // if nick is free create user

        if ($pass != $r_pass) {
            echo 'Passwords must be equal to each other';

            return false;
        }

        $pass = hash('sha512', $pass);

        $res = $this->model->register($login, $email, $pass);

        if ($res) {
            $_SESSION['login'] = $login;

            return true;
        } else {
            return false;
        }
    }
};
