<?php

namespace controllers;

use core\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        $this->view->render('index');
    }
}