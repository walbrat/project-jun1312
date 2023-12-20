<?php

namespace controllers;

use core\BaseController;
use core\BaseModel;
use core\View;

class IndexController extends BaseController
{

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