<?php

namespace controllers\admin;

use core\ResourceController;

class AdminController extends ResourceController
{

    #[\Override] public function index(): void
    {
        // TODO: Implement index() method.
        echo 'AdminController@index';
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

    public function destroy(int $id)
    {
        // TODO: Implement delete() method.
    }
}