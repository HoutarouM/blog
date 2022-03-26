<?php

namespace App\Controller;

class RegisterController implements BasicController
{
    protected $model;

    public function index($url, $data = [])
    {
        $m = $this->getModel($url);

        if (!$m) {
            return;
        }

        $this->render($url);
    }

    private function render($url)
    {
        if (file_exists('./view/' . $url . '.php')) {
            include_once './view/' . $url . '.php';
        } else {
            $data['error_mes'] = 'Nie znałeziono strony :(';

            include_once './view/error.php';
        }
    }

    public function getModel($url)
    {
        if (file_exists('./model/' . $url . 'Model.php')) {
            include './model/' . $url . 'Model.php';

            $this->model = trim('App\Model\ ', ' ') . ucfirst($url) . 'Model';

            $this->model = new $this->model();

            return true;
        } else {
            $data['error_mes'] = 'Nie znałeziono strony :(';

            include './view/error.php';

            return false;
        }
    }

    private function register($login, $email, $pass)
    {
        // hash password
        // execute model method register
        // if nick is free create user

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
