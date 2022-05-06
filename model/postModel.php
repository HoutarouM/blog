<?php

namespace App\Model;

class PostModel extends BasicModel
{
    public $page;

    public function getPostsData($data)
    {
        if (!empty($data[2])) {
            $page = $data[2];
        } else {
            $page = 1;
        }

        $limit_start = ($page - 1) * 5;

        $get_post_data_query = "SELECT * FROM `posty` WHERE `id_posta` = ? OR `id_postu_nadzendnego` = ? LIMIT $limit_start, 5;";

        $this->page = $page;

        $stmt = $this->read($get_post_data_query, [$data[1], $data[1]]);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getAuthorData($post_id)
    {
        $get_post_data_query = "SELECT DISTINCT users.nick FROM `users` JOIN posty on posty.id_autora = users.id WHERE posty.id_posta = ?;";
        $stmt = $this->read($get_post_data_query, [$post_id]);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getLikesData($post_id)
    {
        $get_likes_data_query = "SELECT COUNT(*) FROM `polubienia` JOIN posty ON posty.id_posta = polubienia.id_posta WHERE posty.id_posta = ?;";
        $stmt = $this->read($get_likes_data_query, [$post_id]);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function addComment($parent_post_id, $category_id, $author_id, $text)
    {
        echo $parent_post_id . "<br>";
        echo $category_id . "<br>";
        echo $author_id . "<br>";
        echo $text . "<br>";

        $add_comment_query = "INSERT INTO `posty`(`id_posta`, `id_postu_nadzendnego`, `id_kategorii`, `id_autora`, `tytul`, `text`) 
                                VALUES (NULL, ?, ?, ?, NULL, ?);";

        $this->write($add_comment_query, [$parent_post_id, $category_id, $author_id, $text]);

        return true;
    }

    public function likePost($user_id, $post_id)
    {
        $add_discussion_query = "INSERT INTO `polubienia`(`id`, `id_uzytkownika`, `id_posta`) VALUES (null, ?, ?);";

        $this->write($add_discussion_query, [$user_id, $post_id]);

        return true;
    }

    public function delPost($post_id)
    {
        // delete post likes
        $del_post_likes_query = "DELETE FROM `polubienia` WHERE `id_posta` = ?";
        $this->write($del_post_likes_query, [$post_id]);

        // delete post
        $del_post_query = "DELETE FROM `posty` WHERE `posty`.`id_posta` = ?";
        $this->write($del_post_query, [$post_id]);
    }

    public function getPageCount($data)
    {
        $get_count_post_data_query = "SELECT COUNT(*) FROM `posty` WHERE id_posta = ? OR `id_postu_nadzendnego` = ?";

        $stmt = $this->read($get_count_post_data_query, [$data[1], $data[1]]);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getPage()
    {
        return $this->page;
    }
}
