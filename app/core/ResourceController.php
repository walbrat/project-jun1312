<?php

namespace core;

abstract class ResourceController
{
    protected BaseModel $model;
    protected View $view;

    public function __construct()
    {
        $this->model = new BaseModel();
        $this->view = new View();
    }


    abstract public function index();

    abstract public function create();

    abstract public function show(int $id);

    abstract public function update(int $id);

    abstract public function destroy(int $id);
}