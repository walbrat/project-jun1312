<?php

namespace controllers\admin;

use core\Router;
use core\View;
use models\User;

class InstallController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $view = new View('install_template');
        $page = 'install';
        $this->data['title'] = 'Реєстрація Root користувача';
        $this->data['url'] = Router::getUrl('user', 'create');
        $view->adminRender($page, $this->data);
    }
}