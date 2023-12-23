<?php

namespace controllers\admin;

use core\ResourceController;
use core\Router;
use core\View;
use models\Auth;

class AdminController extends ResourceController
{


    public string $layout = 'admin_layout';

    public function __construct()
    {
        $this->model = new Auth();
        $this->view = new View($this->layout);
    }

    /**
     * @inheritDoc
     */
    public function index(): void
    {
        $this->data['title'] = 'Адмін панель';
//        if (file_exists('install.php')) {
//            Router::redirect('admin/admin/index');
//        }
//        var_dump($this->view);
        $this->view->render('index', $this->data);
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