<?php

namespace App;

require './controller/basicController.php';


class Router
{
    private $controller;
    private $controllerMethod;
    private $controllerMethodParam;

    public function __construct()
    {
        $url = $this->splitURL();

        $this->getController($url);

        $this->getControllerMethodParameters($url);

        $this->getAndExecuteControllerMethod($url);
    }

    private function splitURL()
    {
        /**
         * Check is url not empty
         * if not filter url to prevent injections
         * then split them and return as array
         */
        if (!empty($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

            $_GET['url'] = explode("/", trim($url, '/'));
        } else {
            $_GET['url'][0] = 'posts';
        }

        return $_GET['url'];
    }

    private function getController($url)
    {
        /**
         * Check is controller file exists
         * if exists require controller file and create controller
         * and unset $url[0] variable
         */
        if (file_exists('./controller/' . $url[0] . 'Controller.php')) {
            require_once './controller/' . $url[0] . 'Controller.php';

            $this->controller = trim('App\Controller\ ', ' ') . ucfirst($url[0]) . 'Controller';

            $this->controller = new $this->controller();

            unset($url[0]);
        } else {
            include_once './view/error.php';
        }
    }

    private function getAndExecuteControllerMethod($url)
    {
        /**
         * Check is url have method
         * if have checking if method exists
         * if exists execute method and write method to controllerMethod var
         */

        if (!empty($url[1])) {
            if (method_exists($this->controller, $url[1]))
                $this->controllerMethod = call_user_func(array($this->controller, $url[1]), $this->controllerMethodParam);
        } else {
            $this->controllerMethod = call_user_func(array($this->controller, 'index'), $url[0]);

            if (!empty($_GET['sortCategory']) && !empty($_GET['sortTimeCreated'])) {
                $this->controllerMethod = call_user_func(array($this->controller, 'index'), [$_GET['sortCategory'], $_GET['sortTimeCreated']]);
            } elseif (!empty($_GET['sortCategory'])) {
                $this->controllerMethod = call_user_func(array($this->controller, 'index'), [$_GET['sortCategory']]);
            } elseif (!empty($_GET['sortTimeCreated'])) {
                $this->controllerMethod = call_user_func(array($this->controller, 'index'), [$_GET['sortTimeCreated']]);
            }
        }
    }

    private function getControllerMethodParameters($url)
    {
        /** Check is url contains method parameter
         * if have sava in controllerMethodParam var
         */

        if (!empty($url[1])) {
            array_push($this->controllerMethodParam, $url[1]);
        }
    }
}
