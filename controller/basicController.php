<?php

namespace App\Controller;

/** 
 * Basic methods for controllers
 */
class BasicController
{
    protected $data;

    // basic controller methods
    public function index($url, $data = null)
    {
        if ($data != null) {
            $this->data = $data;
        } else {
            $this->page = 1;
        }

        $m = $this->getModel($url);

        if (!$m) {
            return false;
        }

        $this->render($url);
    }

    public function render($url)
    {
        if (file_exists('../view/' . $url . '.php')) {
            include_once '../view/' . $url . '.php';
        } else {
            $data['error_mes'] = 'Nie znałeziono strony :(';

            include_once '../view/error.php';
        }
    }

    public function getModel($url = 'posts')
    {
        if (file_exists('../model/' . $url . 'Model.php')) {
            include '../model/' . $url . 'Model.php';

            $this->model = trim('App\Model\ ', ' ') . ucfirst($url) . 'Model';

            $this->model = new $this->model();

            return true;
        } else {
            $data['error_mes'] = 'Nie znałeziono strony :(';

            include '../view/error.php';

            return false;
        }
    }

    // basic posts methods
    protected function getPostsData()
    {
        if (!empty($this->data)) {
            return $this->model->getPostsData($this->data);
        } else {
            return $this->model->getPostsData(null);
        }
    }

    protected function getAuthorData($post_id)
    {
        $author_data = $this->model->getAuthorData($post_id);

        if (empty($author_data)) {
            return false;
        }

        return $author_data[0][0];
    }

    protected function getLikesData($post_id)
    {
        $likes_data = $this->model->getLikesData($post_id);

        if (empty($likes_data)) {
            return false;
        }

        return $likes_data[0][0];
    }

    protected function getCategories()
    {
        return $this->model->getCategories();
    }

    public function getPageCount()
    {
        if (!empty($this->data)) {
            if (empty($this->data[2])) {
                $this->data[2] = 'ASC';
            }

            return $this->model->getPageCount($this->data)[0][0];
        } else {
            $this->data[2] = 'ASC';

            return $this->model->getPageCount($this->data)[0][0];
        }
    }

    protected function getPage()
    {
        return $this->model->getPage();
    }
}
