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
    protected  $model;
    /**
     * @var View
     */
    protected  $view;

}