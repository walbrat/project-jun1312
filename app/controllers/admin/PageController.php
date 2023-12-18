<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
class PageController extends BaseController
{
    public function index()
    {
        $page = 'page';
        $data = [];
        $data['title'] = 'Головна сторінка';
        $data['button_name'] = 'Головна';
        $data['content'] = 'Тут буде текст з бази';
        $this->view->adminRender($page, $data);
    }
}