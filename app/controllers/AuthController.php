<?php

namespace controllers;

use core\BaseController;

class AuthController extends BaseController
{
    public function index()
    {
        echo 'Hello from AuthController';
        $this->view->render('auth');
    }
}