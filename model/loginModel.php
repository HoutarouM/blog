<?php

namespace App\Model;

require './model/basicModel.php';

class LoginModel extends BasicModel
{
    public function login($login, $pass)
    {
        $login_query = "SELECT * FROM `users` WHERE `nick` = ? AND `password` = ?";

        $stmt = $this->read($login_query, [$login, $pass]);

        if ($stmt->fetchAll()) {
            return true;
        } else {
            return false;
        }
    }
}
