<?php

namespace App\Model;

require './model/basicModel.php';

class AddPostModel extends BasicModel
{
    public function addDiscussion($category_id, $author_id, $title, $text)
    {
        $add_discussion_query = "INSERT INTO `posty`(`id`, `id_postu_nadzendnego`, `id_kategorii`, `id_autora`, `tytul`, `text`) VALUES (null, null, ?, ?, ?, ?);";

        $this->write($add_discussion_query, [$category_id, $author_id, $title, $text]);

        return true;
    }

    public function getCategories()
    {
        $get_categories_query = "SELECT * FROM `kategorie`";

        $stmt = $this->read($get_categories_query, []);

        $res = $stmt->fetchAll();

        if (empty($res)) {
            return false;
        }

        return $res;
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
