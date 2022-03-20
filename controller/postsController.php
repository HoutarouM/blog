<?php

namespace App\Controller;

class PostsController implements BasicController
{
    protected $model;

    public function render($url, $data = [])
    {
        $this->getModel();

        if (file_exists('./view/' . $url . '.php')) {
            include './view/' . $url . '.php';
        } else {
            // TODO: error page don't exists
        }
    }

    public function getModel($url = 'posts')
    {
        if (file_exists('./model' . $url . 'Model.php')) {
            include './model' . $url . 'Model.php';

            $this->model = trim('App\Model\ ', ' ') . ucfirst($url) . 'Model';

            $this->model = new $this->model();
        } else {
            // TODO: error page don't exists
        }
    }
};
