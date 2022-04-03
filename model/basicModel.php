<?php

namespace App\Model;

class BasicModel extends \App\Database
{
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

    public function getAutourId($login)
    {
        $get_autour_id_query = "SELECT `id` FROM `users` WHERE `nick` = ?";

        $stmt = $this->read($get_autour_id_query, [$login]);

        $res = $stmt->fetchAll();

        if (empty($res)) {
            return false;
        }

        return $res;
    }
}
