<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use models\Page;
use core\Validator;

class PageController extends BaseController
{
//    public Validator $validator;
    public function __construct()
    {
        $this->model = new Page();
        $this->view = new View();
        $this->validator = new Validator();
    }
    
    public function index(): void
    {

        $this->data['pages'] = $this->model->getPages();
        $this->data['create'] =  Router::getUrl('page', 'create');
        $this->view->adminRender('page', $this->data);
    }
    /**
     * @return void
     */
    public function create(): void
    {
        $this->data['url'] = Router::getUrl('page', 'add');
        $this->view->adminRender('create', $this->data);
    }
    public function add(){
        session_start();
        foreach ($_POST as $key => $value) {
            if($this->validator->isEmpty($value)){
                $_SESSION['error'] = "Поле $key пусте";
                Router::redirect(Router::getUrl('page', 'create'));
            } else{
                unset($_SESSION['error']);
                $page[$key] = $value;
            }
        }

        $result = $this->model->addPage($page);

        $url = Router::getUrl('page', 'index');
        if ($result){
            Router::redirect($url);
        }
    }
    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $this->data[] = $this->model->getPage($id);
        $this->data['url'] = Router::getUrl('page', 'update', 'id='.$id);
        $this->view->adminRender('edit', $this->data);
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
        $id =  filter_input(INPUT_GET, 'id');
        $data = [
            'title'=> filter_input(INPUT_POST, 'title'),
            'content'=>filter_input(INPUT_POST, 'content'),
            'btn_name'=> filter_input(INPUT_POST, 'btn_name')
        ];
        $result = $this->model->updatePage($id, $data);
        if($result){
            $url = Router::getUrl('page', 'index', true);
            Router::redirect($url);
        }else{
            $url = Router::getUrl('page', 'error', true);
            Router::redirect($url);
        }
    }

    /**
     * delete page by id
     * @return void
     */
    public function destroy(): void
    {
        $idPage = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $result = $this->model->delPage($idPage);
        if($result){
            $url = Router::getUrl('page', 'index');
            Router::redirect($url);
        }else{
            $url = Router::getUrl('page', 'error');
            Router::redirect($url);
        }
    }
    public function error(): void
    {
        $this->view->adminRender('error');
    }


}
