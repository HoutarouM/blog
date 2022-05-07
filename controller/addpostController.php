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

    protected function addDiscussion($category_id, $author_id, $title, $text, $imgs = null)
    {
        // if category is not chosen return false
        if ($category_id == 0) {
            return false;
        }

        // change to str format for save as a JSON
        if ($imgs != null) {
            $imgs = implode('", "', $imgs);

            $imgs = '["' . $imgs . '"]';
        }

        $res = $this->model->addDiscussion($category_id, $author_id, $title, $text, $imgs);
    }
};
