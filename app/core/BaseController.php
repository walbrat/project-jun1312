<?php

namespace core;

use core\View;
class BaseController
{

    /**
     * @var array
     */
    public array $data = [];
    /**
     * @var array|string[]
     */
    public array $meta = ['title' => '', 'description' => ''];
    /**
     * @var string
     */
    public string $layout = '';
    /**
     * @var BaseModel
     */
    protected BaseModel $model;
    /**
     * @var View
     */
    protected View $view;

    public function __construct() {
        $this->view = new View();
        $this->model = new BaseModel();
    }

}