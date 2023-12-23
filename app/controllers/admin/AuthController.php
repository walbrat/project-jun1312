<?php

namespace controllers\admin;

use core\BaseController;
use core\BaseModel;
use core\View;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->model = new BaseModel();
        $this->view = new View();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        echo 'Hello from AuthController';
        $this->view->render('auth');
    }
}