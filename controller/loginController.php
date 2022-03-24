<?php

namespace App\Controller;

class LoginController implements BasicController
{
    protected $model;

    public function render($url, $data = [])
    {
        $m = $this->getModel($url);

        if (!$m) {
            return;
        }

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

    private function login($login, $pass)
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

            header('location: /php/forum_study/');
        } else {
            echo 'Zly login lub haslo';
        }
    }
};
