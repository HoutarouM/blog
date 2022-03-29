<?php

namespace App\Model;

require './model/basicModel.php';

class PostsModel extends BasicModel
{
    public function getPostsData($data)
    {
        if ($data != null) {
            $get_post_data_query = "SELECT * FROM `posty` WHERE `id` = ? OR `id_postu_nadzendnego` = ?";

            $stmt = $this->read($get_post_data_query, [$data, $data]);
        } else {
            $get_post_data_query = "SELECT * FROM `posty`";

            $stmt = $this->read($get_post_data_query, []);
        }

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

    public function getCategories()
    {
        $get_categories_query = "SELECT * FROM `kategorie`";

        $stmt = $this->read($get_categories_query, []);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
}
