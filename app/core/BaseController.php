<?php

namespace core;

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

}