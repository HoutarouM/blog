<?php

class HomeController implements basicController
{
    public function index()
    {
        include_once './view/home.php';
    }
};
