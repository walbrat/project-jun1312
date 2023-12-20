<?php

namespace core;

class View
{
    protected string $template = 'layout';
<<<<<<<<< Temporary merge branch 1
    public $page;
    const VIEW_DIR = VIEWS_FOLDER;
    const TEMPLATE_DIR = TEMPLATES_FOLDER;
    const PAGE_DIR = PAGES_FOLDER;
    
    public function __construct($template = null)
=========
    protected string $admin_template = 'admin_layout';

    public function __construct($template = null, $admin_template = null)
>>>>>>>>> Temporary merge branch 2
    {
        if ($template !== null) {
            $this->template = $template;
            $this->admin_template = $admin_template;
        }
    }
<<<<<<<<< Temporary merge branch 1
    
    public function render(string $page, array $data = [])
=========

    /**
     * @param string $page
     * @param array $data
     * @return void
     */
    public function render(string $page, array $data = []): void
>>>>>>>>> Temporary merge branch 2
    {
        $this->page = $page;
        extract($data);
<<<<<<<<< Temporary merge branch 1
        include_once $this->getTemplatePath();
    }
    
    private function getPagePath()
    {
        return self::VIEW_DIR . self::PAGE_DIR . DIRECTORY_SEPARATOR . "{$this->page}.php";
    }
    
    private function getTemplatePath()
    {
        return self::TEMPLATE_DIR . DIRECTORY_SEPARATOR . "{$this->template}.php";
=========
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
>>>>>>>>> Temporary merge branch 2
    }
}