<?php

namespace App {

    class Router
    {
        private $controller;
        private $controllerMethod;
        private $controllerMethodParams = [];

        public function __construct()
        {
            $url = $this->splitURL();

            $this->getController($url);
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

                return explode("/", trim($url, '/'));
            } else {
                $_GET['url'][0] = 'home';
                return $_GET['url'];
            }
        }

        private function getController($url)
        {
            /**
             * Check is controller file exists
             * if exists require controller file and create controller
             */
            if (file_exists('./controller/' . $url[0] . 'Controller.php')) {
                require_once('./controller/' . $url[0] . 'Controller.php');

                $this->controller = ucfirst($url[0]) . 'Controller';

                $this->controller = new $this->controller();
            }

            // TODO:
            // add else view error page 
            // error page is not found
        }

        private function getControllerMethod($url)
        {
        }
    }
}
