<?php

namespace App\Controller;

class AddpostController implements BasicController
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

    private function getCategories()
    {
        $categories = $this->model->getCategories();

        if (empty($categories)) {
            return false;
        }

        return $categories;
    }

    private function addPost()
    {
        // TODO: create add post method
    }
};
