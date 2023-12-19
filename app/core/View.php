<?php

namespace core;

class View
{
    protected string $template = 'layout';
    public $page;
    const VIEW_DIR = VIEWS_FOLDER;
    const TEMPLATE_DIR = TEMPLATES_FOLDER;
    const PAGE_DIR = PAGES_FOLDER;

    public function __construct($template = null)
    {
        if ($template !== null) {
            $this->template = $template;
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