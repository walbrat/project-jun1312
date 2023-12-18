<?php

namespace controllers;

use core\ResourceController;

class PageController extends ResourceController
{

    #[\Override] public function index()
    {
        $page = 'index';
        $data = [];
        $data['title'] = 'Головна сторінка';
        $data['button_name'] = 'Головна';
        $data['content'] = 'Тут буде текст з бази';
        $this->view->render($page, $data);
    }

    #[\Override] public function create()
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

    #[\Override] public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }
}