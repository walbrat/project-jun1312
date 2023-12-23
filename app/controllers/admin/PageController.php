<?php

namespace controllers\admin;

use core\ResourceController;

class PageController extends ResourceController
{

    public function index(): void
    {
        $this->data['title'] = 'Головна сторінка';
        $this->data['button_name'] = 'Головна';
        $this->data['content'] = 'Тут буде текст з бази';
        $this->view->render('index', $this->data);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        // TODO: Implement create() method.
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id): void
    {
        // TODO: Implement show() method.
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id): void
    {
        // TODO: Implement update() method.
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        // TODO: Implement destroy() method.
    }
}