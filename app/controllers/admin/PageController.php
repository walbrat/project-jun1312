<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use models\Page;

class PageController extends BaseController
{
    public function __construct()
    {
        $this->model = new Page();
        $this->view = new View();
    }
    
    public function index(): void
    {
//        $this->data['title'] = 'Головна сторінка';
//        $this->data['button_name'] = 'Головна';
//        $this->data['content'] = 'Тут буде текст з бази';
        $this->data['pages'] = $this->model->getPages();
        $this->view->adminRender('page', $this->data);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $title = filter_input(INPUT_POST, 'title');
        $content = filter_input(INPUT_POST, 'content');
        $btn_name = filter_input(INPUT_POST, 'btn_name');
        $page = [
            'title'=> $title,
            'content'=>$content,
            'btn_name'=>$btn_name
        ];
    
        $result = $this->model->addPage($page);
        if($result){
            $url = Router::getUrl('page', 'index', true);
            Router::redirect($url);
        }else{
            $url = Router::getUrl('page', 'error', true);
            Router::redirect($url);
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(): void
    {
        // TODO: Implement show() method.
    }

    /**
     *
     * @return void
     */
    public function update(): void
    {
        $idPage = filter_input(INPUT_POST, 'idPage');
        $title = filter_input(INPUT_POST, 'title');
        $content = filter_input(INPUT_POST, 'content');
        $btn_name = filter_input(INPUT_POST, 'btn_name');
        $page = [
            'title'=> $title,
            'content'=>$content,
            'btn_name'=>$btn_name
        ];
    
        $result = $this->model->updatePage($idPage, $page);
        if($result){
            $url = Router::getUrl('page', 'index', true);
            Router::redirect($url);
        }else{
            $url = Router::getUrl('page', 'error', true);
            Router::redirect($url);
        }
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        $idPage = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $result = $this->model->delPage($idPage);
        if($result){
            $url = Router::getUrl('page', 'index', true);
            Router::redirect($url);
        }else{
            $url = Router::getUrl('page', 'error', true);
            Router::redirect($url);
        }
    }
    public function error(): void
    {
        $this->view->adminRender('error');
    }
    
    public function getform(): void
    {
        $idPage = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        var_dump($idPage);
        if($idPage){
            $result = $this->model->getPage($idPage);
            $result['actionForForm'] = Router::getUrl('page', 'update',true);
            $result['buttonText'] = 'Edit';
            $this->view->adminRender('form', $result);
        }else{
            $result['actionForForm'] = Router::getUrl('page', 'create',true);
            $result['buttonText'] = 'Create';
            $this->view->adminRender('form', $result);
        }
    }
}
