<?php

namespace controllers\admin;

use core\ResourceController;
use core\Router;
use core\View;

class AdminController extends ResourceController
{

    #[\Override] public function index()
    {
        $page = 'index';
        $data = [];
        $data['title'] = 'Адмін панель';
        if (file_exists('install.php')) {
            Router::redirect('/install.php');
        }
        $this->view->adminRender($page, $data);
    }

    #[\Override] public function create()
    {
        // TODO: Implement create() method.
    }

    public function rootcreate()
    {
        // TODO: Implement create() method.
    }

    #[\Override] public function show(int $id)
    {
        // TODO: Implement show() method.
    }

    #[\Override] public function update(int $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $id)
    {
        // TODO: Implement delete() method.
    }
}