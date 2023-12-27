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
        $id = filter_input(INPUT_GET, 'id');
        $modelPage = new Page();
        $page = null;
        if($id){
            $page = $modelPage->getPage($id);
        }else{
            $pages = $modelPage->getPages();
            if(isset($pages[0])){
                $page = $pages[0];
            }
        }
        if ($page){
            $this->data['title'] = $page['title'];
            $this->data['content'] = $page['content'];
            $this->data['menuBtns'] = $this->showMenu();
                $this->view->render('index', $this->data);
        }else{
            $this->data['title'] = 'Page not found';
            $this->view->render('page_not_found', $this->data);
        }
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