<?php

namespace App\Controller;

class PostController extends BasicController
{
    protected function getAutourId($login)
    {
        $author_id = $this->model->getAutourId($login);

        if (empty($author_id)) {
            return false;
        }

        return $author_id[0];
    }

    protected function addComment($parent_post_id, $category_id, $author_id, $text)
    {
        if ($category_id == 0) {
            return false;
        }

        $res = $this->model->addComment($parent_post_id, $category_id, $author_id, $text);

        return true;
    }

    protected function likePost($user_id, $post_id)
    {
        $this->model->likePost($user_id, $post_id);
    }

    protected function delPost($post_id)
    {
        $this->model->delPost($post_id);
    }
};
