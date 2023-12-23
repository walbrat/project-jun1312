<?php

namespace controllers\admin;

use core\BaseController;
use core\BaseModel;
use core\Router;
use core\View;
use helpers\Session;
use helpers\Validator;

class AuthController extends BaseController
{
    public string $layout = 'admin_layout';

    public function __construct()
    {
        $this->model = new BaseModel();
        $this->view = new View($this->layout);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $this->view->render('auth');
    }

    public function login()
    {

        $this->view->render('login', [
            'login' => Session::getValue('login'),
            'errors' => Session::getErrors(),
        ]);
    }

    public function checkLogin()
    {
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        Validator::checkListInput([$login, $password]);
        $user = $this->model->getUserByLogin($login);
        $realPass = password_verify($password, $user['password']);
        var_dump($login, $password_hash, $user, $realPass);

        if ($realPass) {
            echo 'ok';
            $this->view->render('page');
            Session::setValue('login', $login);
        } else {
            echo 'no';
            Session::delFromSession('errors');
            $errors[] = 'incorrect login or password!';
            Session::setErrors($errors);
            Session::setValue('login', $login);
            $this->view->render('login');
        }

    }

    public function register()
    {
        $this->view->render('register', [
            'login' => Session::getValue('login'),
            'email' => Session::getValue('email'),
            'errors' => Session::getErrors(),
        ]);
    }

    public function checkRegister()
    {
        $login = filter_input(INPUT_POST, 'login');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $conf_password = filter_input(INPUT_POST, 'password_confirm');
        Validator::checkListInput([$login, $email, $password]);
        if (!Validator::equalPass($password, $conf_password)) {
            $this->view->render('register');
        }
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        session_start();
        if (!empty($_SESSION['errors'])) {
            Session::setValue('login', $login);
            Session::setValue('email', $email);

        } else {
            $this->model->addUser($login, $hash_pass, $email);
            Session::delFromSession();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        Router::redirect('/');
    }

}