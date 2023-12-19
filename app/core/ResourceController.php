<?php

namespace core;

abstract class ResourceController
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


    /**
     * @return void
     */
    abstract public function index(): void;

    /**
     * @return void
     */
    abstract public function create(): void;

    /**
     * @param int $id
     * @return void
     */
    abstract public function show(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    abstract public function update(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    abstract public function destroy(int $id): void;
}