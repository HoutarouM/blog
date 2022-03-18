<?php

use App as A;

require 'router.php';

class App
{
    public function __construct()
    {
        $router = new A\Router();
    }
}

$app = new App();
