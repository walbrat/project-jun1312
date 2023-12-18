<?php

namespace core;

class View
{
    protected string $template = 'layout';
    protected string $admin_template = 'admin_layout';

    public function __construct($template = null, $admin_template = null)
    {
        if ($template !== null) {
            $this->template = $template;
            $this->admin_template = $admin_template;
        }
    }

    public function render(string $page, array $data = [])
    {
        extract($data);
        include_once TEMPLATES_FOLDER . $this->template . '.php';
    }

    public function adminRender(string $page, array $data = [])
    {
        extract($data);
        include_once TEMPLATES_FOLDER . $this->admin_template . '.php';
    }
}