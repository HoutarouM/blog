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
}
