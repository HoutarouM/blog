<?php

namespace App\Model;

class PostsModel extends BasicModel
{
    public $page;

    public function getPostsData($data)
    {
        $get_post_data_query = $this->getPostDataQuery($data);

        $stmt = $this->read($get_post_data_query, []);

        $data = $stmt->fetchAll();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    private function getPostDataQuery($data)
    {
        if (!empty($data[3])) {
            $page = $data[3];
        } else if (!empty($data[1])) {
            $page = $data[1];
        } else {
            $page = 1;
        }

        $limit_start = ($page - 1) * 5;

        if (!empty($data[1])) {
            // if sort params exist
            switch ($data[1]) {
                case 'time':
                    $get_post_data_query = "SELECT * FROM `posty` 
                                                WHERE isNull(`id_postu_nadzendnego`)
                                                ORDER BY `id` $data[2]
                                                LIMIT $limit_start, 5;";

                    break;
                case 'likes':
                    // sort by likes count
                    $get_post_data_query = "SELECT * FROM `posty` 
                                                LEFT JOIN `polubienia` ON `polubienia`.`id_posta` = `posty`.`id`
                                                WHERE isNull(`posty`.`id_postu_nadzendnego`) 
                                                GROUP BY `posty`.`id` 
                                                ORDER BY (COUNT(`polubienia`.`id_posta`)) $data[2]
                                                LIMIT $limit_start, 5;";

                    break;
                default:
                    // sort params not exist
                    // default order by params 
                    // (no sort)
                    $get_post_data_query = "SELECT * FROM `posty` 
                                                WHERE isNull(`id_postu_nadzendnego`) 
                                                ORDER BY `id` ASC
                                                LIMIT $limit_start, 5;";

                    break;
            }
        } else {
            // sort params not exist
            // default order by params 
            // (no sort)
            $get_post_data_query = "SELECT * FROM `posty` 
                                        WHERE isNull(`id_postu_nadzendnego`) 
                                        ORDER BY `id` ASC
                                        LIMIT $limit_start, 5;";
        }

        $this->page = $page;

        return $get_post_data_query;
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

    public function getPageCount($data)
    {
        if (!empty($data[1])) {
            // if sort params exist
            switch ($data[1]) {
                case 'time':
                    // sort by time created by id
                    $get_count_post_data_query = "SELECT COUNT(*) FROM `posty` 
                                                    WHERE isNull(`id_postu_nadzendnego`)
                                                    ORDER BY `id` $data[2]";

                    break;
                case 'likes':
                    // sort by likes count
                    $get_count_post_data_query = "SELECT COUNT(*) FROM `posty` 
                                                    JOIN polubienia ON polubienia.id_posta = posty.id 
                                                    WHERE isNull(posty.`id_postu_nadzendnego`) 
                                                    ORDER BY (COUNT(polubienia.id_posta)) $data[2];";

                    break;
                default:
                    // sort params not exist
                    // default order by params 
                    // (no sort)
                    $get_count_post_data_query = "SELECT COUNT(*) FROM `posty` 
                                                    WHERE isNull(`id_postu_nadzendnego`)
                                                    ORDER BY `id` $data[2]";
            }
        } else {
            // sort params not exist
            // default order by params 
            // (no sort)
            $get_count_post_data_query = "SELECT COUNT(*) FROM `posty` 
                                            WHERE isNull(`id_postu_nadzendnego`)
                                            ORDER BY `id` $data[2]";
        }

        // echo $get_count_post_data_query;

        $stmt = $this->read($get_count_post_data_query, []);

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
