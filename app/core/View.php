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

    /**
     * @param string $page
     * @param array $data
     * @return void
     */
    public function render(string $page, array $data = []): void
    {
        extract($data);
        include_once TEMPLATES_DIR . $this->template . '.php';
    }

    /**
     * @param string $page
     * @param array $data
     * @return void
     */
    public function adminRender(string $page, array $data = []): void
    {
        extract($data);
        include_once TEMPLATES_DIR . $this->admin_template . '.php';
    }
}