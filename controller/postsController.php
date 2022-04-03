<?php

namespace App\Controller;

class PostsController extends BasicController
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

    protected function getPostsData()
    {
        $data = null;

        if (!empty($this->data)) {
            $data = $this->data;
        }

        $posts_data = $this->model->getPostsData($data);

        if (empty($posts_data)) {
            return false;
        }

        return $posts_data;
    }

    protected function getAutourId($login)
    {
        $author_id = $this->model->getAutourId($login);

        if (empty($author_id)) {
            return false;
        }

        return $author_id[0];
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

    protected function addComment($parent_post_id, $category_id, $author_id, $text)
    {
        // if category is not chosen return false
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
};
