<?php

namespace App\Model;

class RegisterModel extends BasicModel
{
    public function register($login, $email, $pass)
    {
        // check is user nick is already used
        // if not create a new user
        if (!$this->check_is_nick_already_used($login)) {
            return false;
        }

        $register_query = "INSERT INTO `users`(`id`, `email`, `password`, `nick`) VALUES (null, ?, ?, ?);";

        $this->write($register_query, [$email, $pass, $login]);

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
