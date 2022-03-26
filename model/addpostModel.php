<?php

namespace App\Model;

require './model/basicModel.php';

class AddPostModel extends BasicModel
{
    public function addPost()
    {
        // TODO: add addPost method
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
}
