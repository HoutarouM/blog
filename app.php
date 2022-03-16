<?php


class App
{
    private $controller;

    public function __construct()
    {
        $url = $this->splitURL();

        $this->router($url);
    }

    private function splitURL()
    {
        if (!empty($_GET['url'])) {
            return explode("/", trim($_GET['url'], '/'));
        } else {
            $_GET['url'][0] = 'home';
            return $_GET['url'];
        }
    }

    private function router($url)
    {
        if (file_exists('./controller/' . $url[0] . 'Controller.php')) {
            require_once('./controller/' . $url[0] . 'Controller.php');

            $this->controller = ucfirst($url[0]) . 'Controller';

            $this->controller = new $this->controller();
        }
    }
}
