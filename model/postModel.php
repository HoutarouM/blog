<?php

namespace App\Model;

class PostModel extends BasicModel
{
    public function getPostsData($data)
    {
        $get_post_data_query = "SELECT * FROM `posty` WHERE  `id_postu_nadzendnego` = ?";

        $stmt = $this->read($get_post_data_query, [$data[1]]);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getAuthorData($post_id)
    {
        $get_post_data_query = "SELECT DISTINCT users.nick FROM `users` JOIN posty on posty.id_autora = users.id WHERE posty.id = ?;";
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
        $get_likes_data_query = "SELECT COUNT(*) FROM `polubienia` JOIN posty ON posty.id = polubienia.id_posta WHERE posty.id = ?;";
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
        $add_comment_query = "INSERT INTO `posty`(`id`, `id_postu_nadzendnego`, `id_kategorii`, `id_autora`, `tytul`, `text`) VALUES (NULL, ?, ?, ?, NULL, ?);";

        $this->write($add_comment_query, [$parent_post_id, $category_id, $author_id, $text]);

        return true;
    }

    public function likePost($user_id, $post_id)
    {
        $add_discussion_query = "INSERT INTO `polubienia`(`id`, `id_uzytkownika`, `id_posta`) VALUES (null, ?, ?);";

        $this->write($add_discussion_query, [$user_id, $post_id]);

        return true;
    }
}
