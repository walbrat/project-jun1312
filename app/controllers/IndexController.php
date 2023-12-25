<?php

namespace controllers;

use core\BaseController;
use core\Router;
use models\Page;

class IndexController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $id = filter_input(INPUT_GET, 'id') ?? 1;
        $modelPage = new Page();
        $page = $modelPage->getPage($id);
        $this->data['title'] = $page['title'];
        $this->data['content'] = $page['content'];
        $this->data['menuBtns'] = $this->showMenu();
        $this->view->render('index', $this->data);
    }

    public  function showMenu()
    {
        $modelPage = new Page();
        $pages = $modelPage->getPages();
        foreach ($pages as $page){
            $menuBtns[] = [
                'url' => Router::getUrl('index','index', 'id='.$page['id']),
                'btn_name' => $page['btn_name']
            ];
        }
        return $menuBtns;
    }
}