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
    
    public function render(string $page, array $data = [])
    {
        $this->page = $page;
        extract($data);
        include_once $this->getTemplatePath();
    }
    
    private function getPagePath()
    {
        return self::VIEW_DIR . self::PAGE_DIR . DIRECTORY_SEPARATOR . "{$this->page}.php";
    }
    
    private function getTemplatePath()
    {
        return self::TEMPLATE_DIR . DIRECTORY_SEPARATOR . "{$this->template}.php";
    }
}