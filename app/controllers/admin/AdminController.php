<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use models\User;


class AdminController extends BaseController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $page = 'index';
        $this->data['title'] = 'Адмін панель';
        $this->view->adminRender($page, $this->data);
    }
}