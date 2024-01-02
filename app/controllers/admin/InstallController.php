<?php

namespace controllers\admin;

use core\Router;
use core\View;
use helpers\Session;

class InstallController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $view = new View('registration_layout');
        $page = 'user_form';
        $this->data['title'] = 'Root user registration';
        $this->data['text_btn'] = 'Save';
        $this->data['text_btn_cancel'] = 'Cancel';
        $this->data['password'] = Session::getValue('password');
        $this->data['password_confirm'] = Session::getValue('password_confirm');
        $this->data['errors'] = Session::getErrors();
        $this->data['url'] = Router::getUrl('user', 'store');
        $this->data['url_cancel'] = Router::getUrl('auth','index');
        $view->adminRender($page, $this->data);
    }
}