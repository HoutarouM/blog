<?php

namespace App\Model;

require './model/basicModel.php';

class LoginModel extends BasicModel
{
    protected function login($login, $pass)
    {
        $login_query = "SELECT * FROM `users` WHERE `nick` = ? AND `haslo` = ?";

        $this->read($login_query, [$login, $pass]);
    }
}
