<?php

namespace controllers\admin;

use core\ResourceController;
use core\Router;

class AdminController extends ResourceController
{


    /**
     * @inheritDoc
     */
    public function index(): void
    {
        $this->data['title'] = 'Адмін панель';
        if (file_exists('install.php')) {
            Router::redirect('/install.php');
        }
        $this->view->adminRender('index', $this->data);
    }

    /**
     * @inheritDoc
     */
    public function create(): void
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function show(int $id): void
    {
        // TODO: Implement show() method.
    }

    /**
     * @inheritDoc
     */
    public function update(int $id): void
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id): void
    {
        // TODO: Implement destroy() method.
    }
}