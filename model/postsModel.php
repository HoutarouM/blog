<?php

namespace App\Model;

require './model/basicModel.php';

class PostsModel extends BasicModel
{
    public function getPostsData($data = [])
    {
        // if (empty($data)) {
        //     $data = ['ASC', 0];
        // }

        if ($data[1] == 0) {
            $get_post_data_query = "SELECT * FROM `posty` WHERE JOIN kategorie ON kategorie.id = posty.id_kategorii ORDER BY ? ";

            $stmt = $this->read($get_post_data_query, $data);
        } else {
            $get_post_data_query = "SELECT * FROM `posty` WHERE JOIN kategorie ON kategorie.id = posty.id_kategorii WHERE kategorie.kategoria = ? ORDER BY ? ";

            $stmt = $this->read($get_post_data_query, $data);
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
