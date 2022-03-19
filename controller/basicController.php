<?php

namespace App\Controller;

/** All controllers must have:
 *  - model var
 *  - index method
 *  - getModel method
 */
interface BasicController
{
    protected $model;

    public function index($url);

    public function getModel($url);
}
