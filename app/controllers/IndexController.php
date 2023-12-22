<?php

namespace controllers;

use core\BaseController;
use core\BaseModel;
use core\View;
use models\Page;

class IndexController extends BaseController
{

    public function __construct()
    {
        $this->model = new BaseModel();
        $this->view = new View();
    }

    /**
     * @param int|null $id
     */
    public function index(int $id=null): void
    {

        $page=new Page();
        $pages=$page->getPages();
        foreach ($pages as $page){
            if ($page['id']==$id ){
                $this->data['title'] = $page['content'];
            }
        }
        $this->data['content'] = $pages;
        $this->view->render('index', $this->data);
    }
}