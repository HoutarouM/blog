<?php

namespace App\Model;

require './model/basicModel.php';

class RegisterModel extends BasicModel
{
    public function register($login, $email, $pass)
    {
        if (!$this->check_is_nick_already_used($login)) {
            return false;
        }

        $register_query = "INSERT INTO `users`(`id`, `email`, `password`, `nick`) VALUES (null, ?, ?, ?);";

        $this->write($register_query, [$login, $email, $pass]);

        return true;
    }

    private function check_is_nick_already_used($login)
    {
        $chech_login_query = "SELECT * FROM `users` WHERE `nick` = ?";

        $stmt = $this->read($chech_login_query, [$login]);

        if (!empty($stmt->fetchAll())) {
            return false;
        }

        return true;
    }
}
