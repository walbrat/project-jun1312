<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use models\User;

class UserController extends BaseController
{
    public function index()
    {
        $page = 'user';
        $data = [];
        $data['title'] = 'Головна сторінка';
        $data['button_name'] = 'Головна';
        $data['content'] = 'Тут буде текст з бази';
        $this->view->adminRender($page, $data);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $data['login'] = filter_input(INPUT_POST, 'login');
        $data['email'] = filter_input(INPUT_POST, 'email');
        $data['password'] = password_hash(filter_input(INPUT_POST, 'pass'), PASSWORD_DEFAULT);
        $users = new User();
        if ($users->create($data)) {
            Router::redirect('index');
        } else {
            throw new \Exception('Помилка запису у БД');
            Router::redirect('create');
        }
    }

    public function logout()
    {
        Router::redirect('/');
    }

}