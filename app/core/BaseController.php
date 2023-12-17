<?php

namespace core;

class BaseController
{

    protected BaseModel $model;
    protected View $view;

    public function __construct()
    {
        $this->model = new BaseModel();
        $this->view = new View();
    }
}