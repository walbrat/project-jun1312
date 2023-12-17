<?php

namespace controllers;

use core\ResourceController;

class PageController extends ResourceController
{

    #[\Override] public function index()
    {
        echo 'hello from PageController';
        $this->view->render('page');
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