<?php

namespace App\Controller;

/** 
 * Basic methods for controllers
 */
class BasicController
{
    protected $data;

    public function index($url, $data = null)
    {
        if ($data != null) {
            $this->data = $data;
        }

        $m = $this->getModel($url);

        if (!$m) {
            return false;
        }

        $this->render($url);
    }

    public function render($url)
    {
        if (file_exists('./view/' . $url . '.php')) {
            include_once './view/' . $url . '.php';
        } else {
            $data['error_mes'] = 'Nie znałeziono strony :(';

            include_once './view/error.php';
        }
    }

    public function getModel($url = 'posts')
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
}
