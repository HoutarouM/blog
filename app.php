<?php

namespace App;

require_once '../config.php';
require_once '../router.php';
require_once '../model/database.php';
require_once '../model/basicModel.php';


class App
{
    public function __construct()
    {
        $router = new Router();
    }
}
