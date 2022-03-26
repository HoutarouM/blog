<?php

namespace App\Controller;

/** All controllers must have:
 *  - model var
 *  - index method
 *  - getModel method
 */
interface BasicController
{
    public function index($url, $data);
}
