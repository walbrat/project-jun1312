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
        $this->data['text_btn'] = 'Зберігти';
        $this->data['url'] = Router::getUrl('user', 'store');
        $view->adminRender($page, $this->data);
    }
}