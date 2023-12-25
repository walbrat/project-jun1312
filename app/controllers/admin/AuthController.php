<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use helpers\Session;
use helpers\Validator;
use models\Auth;

class AuthController extends BaseController
{
    /**
     * @var string
     */
    public string $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->view = new View($this->layout);
        $this->model = new Auth();
    }

    /**
     * @return void
     */
    public function login(): void
    {

        $this->view->adminRender('login', [
            'login' => Session::getValue('login'),
            'errors' => Session::getErrors(),
        ]);
    }

    /**
     * @return void
     */
    public function checkLogin(): void
    {
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');
//        var_dump($login, $password);
        $is_valid = Validator::checkListInput([$login, $password]);
        if (!$is_valid) {
            Router::redirect('login');
        }
        $user = $this->model->getUserByLogin($login);
        $realPass = password_verify($password, $user['password']);

        if ($realPass) {
            Session::setValue('login', $login);
            $this->view->adminRender('dashboard', [
                'login' => $login,
            ]);
        } else {
            Session::delFromSession('errors');
            $errors[] = 'incorrect login or password!';
            Session::setErrors($errors);
            Session::setValue('login', $login);
            Router::redirect('login');
        }

    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->view->adminRender('register', [
            'login' => Session::getValue('login'),
            'email' => Session::getValue('email'),
            'errors' => Session::getErrors(),
        ]);
    }

    /**
     * @return void
     */
    public function checkRegister(): void
    {
        $login = filter_input(INPUT_POST, 'login');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $conf_password = filter_input(INPUT_POST, 'password_confirm');
        Validator::checkListInput([$login, $email, $password]);
        if (!Validator::equalPass($password, $conf_password)) {
            Router::redirect('register');
        }
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        if (!empty($_SESSION['errors'])) {
            Session::setValue('login', $login);
            Session::setValue('email', $email);
            Router::redirect('register');

        } else {
            $this->model->addUser($login, $hash_pass, $email);
            Session::delFromSession();
            Router::redirect('');
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
        Router::redirect('/');
    }

}