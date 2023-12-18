<?php

namespace controllers;

use core\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        $data = [];
        $data['title'] = 'Головна сторінка';
        $data['button_name'] = 'Головна';
        $data['content'] = 'Тут буде текст з бази';
        $this->view->render('index', $data);
    }
}