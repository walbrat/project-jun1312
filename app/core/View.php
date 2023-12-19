<?php

namespace core;

class View
{

    public $page;
    protected string $template = 'layout';

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
        $this->page = $page;
        extract($data);
        include_once $this->getTemplatePath();
    }

    private function getTemplatePath()
    {
        return TEMPLATES_DIR . DIRECTORY_SEPARATOR . "{$this->template}.php";

    }

    private function getPagePath()
    {
        return VIEW_DIR . PAGES_DIR . DIRECTORY_SEPARATOR . "{$this->page}.php";
    }
}