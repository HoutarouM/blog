<?php

namespace App\Controller;

class AddpostController extends BasicController
{
    protected function getCategories()
    {
        $categories = $this->model->getCategories();

        if (empty($categories)) {
            return false;
        }

        return $categories;
    }

    protected function getAutourId($login)
    {
        $author_id = $this->model->getAutourId($login);

        if (!$author_id) {
            return false;
        }

        return $author_id[0];
    }

    protected function addDiscussion($category_id, $author_id, $title, $text)
    {
        // if category is not chosen return false
        if ($category_id == 0) {
            return false;
        }

        $res = $this->model->addDiscussion($category_id, $author_id, $title, $text);
    }
};
