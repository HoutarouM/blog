<?php

namespace App\Model;

class AddPostModel extends BasicModel
{
    public function addDiscussion($category_id, $author_id, $title, $text)
    {
        $add_discussion_query = "INSERT INTO `posty`(`id_posta`, `id_postu_nadzendnego`, `id_kategorii`, `id_autora`, `tytul`, `text`) VALUES (null, null, ?, ?, ?, ?);";

        $this->write($add_discussion_query, [$category_id, $author_id, $title, $text]);

        return true;
    }
}
