<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use models\Page;
use core\Validator;

class PageController extends BaseController
{
    public Validator $validator;
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
        foreach ($_POST as $key => $value) {
            $page[$key] = $value;
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
    
    /**
     * render form for creat or update
     * @return void
     */
    public function getform(): void
    {
        $result = [];
        session_start();
        if(isset($_SESSION['page_form_validation'])) {
            $errorsFromSession = $_SESSION['page_form_validation'];
            unset($_SESSION['page_form_validation']);
            $result['errors'] = json_decode($errorsFromSession, 1);
        }
        $idPage = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if($idPage){
            $result = array_merge($this->model->getPage($idPage), $result);
            $result['actionForForm'] = Router::getUrl('page', 'update');
            $result['buttonText'] = 'Edit';
        }else{
            $result['actionForForm'] = Router::getUrl('page', 'create');
            $result['buttonText'] = 'Create';
        }
        $this->view->adminRender('form', $result);
    }
    
    /**
     * validation data from form
     * @param $title
     * @param $content
     * @param $btn_name
     * @param $idPage
     * @return void
     */
    protected function doValidation($title, $content, $btn_name, $idPage = null)
    {
        $errors = [];
        if ($this->validator->isEmpty($title) || !$this->validator->matchingLength($title, Page::LENGTH_TITLE)) {
            $errors['title'] = 'Поле Title порожнє або кількість символів більше ' . Page::LENGTH_TITLE;
        }
        if ($this->validator->isEmpty($content) || !$this->validator->matchingLength($content, Page::LENGTH_CONTENT)) {
            $errors['content'] = 'Поле Content порожнє або кількість символів більше ' . Page::LENGTH_CONTENT;
        }
        if ($this->validator->isEmpty($btn_name) || !$this->validator->matchingLength($btn_name, Page::LENGTH_BTN_NAME)) {
            $errors['btn_name']= 'Поле Btn_name порожнє або кількість символів більше ' . Page::LENGTH_BTN_NAME;
        }
        if(!empty($errors)){
            session_start();
            $_SESSION['page_form_validation'] = json_encode($errors);
            $getParameterId = '';
            if ($idPage) {
                $getParameterId = 'id=' . $idPage;
            }
            $url = Router::getUrl('page', 'getform', $getParameterId);
            Router::redirect($url);
        }
        
    }
}
