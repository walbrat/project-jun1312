<?php

namespace core;

class View
{
    protected string $template = 'layout';

    public function __construct($template = null)
    {
        if ($template !== null) {
            $this->template = $template;
        }
    }

    public function render(string $page, array $data = [])
    {
        extract($data);
        include_once TEMPLATES_FOLDER . $this->template . '.php';
    }
}