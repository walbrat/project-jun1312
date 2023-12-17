<?php

namespace controllers;

use core\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        echo 'hello from IndexController';
        $this->view->render('index');
    }
}