<?php

namespace App\Model;

require './model/basicModel.php';

// TODO: create posts model
class LoginModel extends BasicModel
{
    protected function login($login, $pass)
    {
        $login_query = "SELECT * FROM `users` WHERE `nick` = :login AND `haslo` = :pass";

        $this->read($login_query, [$login, $pass]);
    }
}
