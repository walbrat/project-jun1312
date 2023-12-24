<?php

namespace controllers;

use core\BaseController;

class IndexController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $this->data['title'] = 'Головна сторінка';
        $this->data['button_name'] = 'Головна';
        $this->data['content'] = 'Тут буде текст з бази';
        $this->view->render('index', $this->data);
    }
}