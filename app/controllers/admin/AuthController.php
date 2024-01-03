<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use helpers\Session;
use core\Validator;
use models\User;

class AuthController extends BaseController
{
    /**
     * @var string
     */
    public string $layout = 'registration_layout';

    public function __construct()
    {
        parent::__construct();
        $this->view = new View($this->layout);
        $this->model = new User();
    }
    /**
     * render index page or form login
     * @return void
     */
    public function index(): void
    {
        if (Session::isAuth()) {
            $url = Router::getUrl('admin', 'index');
            Router::redirect($url);
        } else {
            $this->checkRootUser();
            $page = 'login';
            $this->data['title'] = 'Authorization';
            $this->data['text_btn'] = 'Sign in';
            $this->data['text_btn_cancel'] = 'Cancel';
            $this->data['login'] = Session::getValue('login');
            $this->data['password'] = Session::getValue('password');
            $this->data['errors'] = Session::getErrors();
            $this->data['url'] = Router::getUrl('auth', 'login');
            $this->view->adminRender($page, $this->data);
        }
    }

    /**
     * Цей метод перевіряє існування файла install.php, та чи є в базі даних користувачі.
     */
    public function checkRootUser()
    {
        $installControllerFile =  __DIR__ . DIRECTORY_SEPARATOR . 'InstallController.php';
        if (file_exists($installControllerFile)) {
            $view = new View('registration_layout');
            $page = 'user_form';
            $this->data['title'] = 'Root user registration';
            $this->data['text_btn'] = 'Save';
            $this->data['text_btn_cancel'] = 'Cancel';
            $this->data['password'] = Session::getValue('password');
            $this->data['password_confirm'] = Session::getValue('password_confirm');
            $this->data['errors'] = Session::getErrors();
            $this->data['url'] = Router::getUrl('auth', 'store');
            $this->data['url_cancel'] = Router::getUrl('auth','index');
            $view->adminRender($page, $this->data);
        }
    }

    /**
     * Запис в БД даних нового адміністратора
     * @return void
     * @throws \Exception
     */
    public function store(): void
    {
        $users = new User();
        $this->data['login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->data['email'] = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $this->data['password'] = filter_input(INPUT_POST, 'password');
        $this->data['password_confirm'] = filter_input(INPUT_POST, 'password_confirm');
        foreach ($this->data as $key => $value) {
            Session::setValue($key, $value);
        }
        $doValidation = $this->doValidation($this->data);
        if (empty($doValidation)) {
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
            if ($users->create($this->data)) {
                Session::delFromSession($this->data);
                $installControllerFile =  __DIR__ . DIRECTORY_SEPARATOR . 'InstallController.php';
                if (file_exists($installControllerFile)) {
                    unlink($installControllerFile);
                }
                $url = Router::getUrl('auth', 'index');
                Router::redirect($url);
            } else {
                throw new \Exception('Помилка запису у БД');
            }
        } else {
            Session::setErrors($doValidation);
            Router::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * @return void
     */
    public function login(): void
    {
        $this->data['login'] = filter_input(INPUT_POST, 'login');
        $this->data['password'] = filter_input(INPUT_POST, 'password');
        foreach ($this->data as $key => $value) {
            Session::setValue($key, $value);
        }
        $doValidation = $this->doValidation($this->data);
        if (empty($doValidation)) {
            if ($this->authentication($this->data['login'], $this->data['password'])) {
                Session::delFromSession($this->data);
                $url = Router::getUrl('admin','index');
                Router::redirect($url);
            } else {
                $url = Router::getUrl('auth','index');
                Router::redirect($url);
            }
        } else {
            Session::setErrors($doValidation);
            Router::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function authentication(string $login, string $password) : bool
    {
        $user = $this->model->getUserByLogin($login);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->setUser($user);
                return true;
            } else {
                $errors['login'] = "Пара логін пароль не співпадає";
                $errors['password'] = "Пара логін пароль не співпадає";
                Session::setErrors($errors);
            }
        } else {
            $errors['login'] = "Пара логін пароль не співпадає";
            $errors['password'] = "Пара логін пароль не співпадає";
            Session::setErrors($errors);
        }
        return false;
    }

    /**
     * @param array $data
     * @return void
     */
    public function setUser(array $data) : void
    {
        Session::setValue('user', $data);
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

    /**
     * @param array $filds
     * @return array
     */
    protected function doValidation(array $filds) : array
    {
        $errors = [];
        $validator = new Validator();
        foreach ($filds as $fild => $value) {
            if (empty($value)) {
                $errors[$fild] = "Поле має бути заповнене.";
            } else {
                if ($fild == 'login' && !$validator->matchingLength($value, 100)) {
                    $errors[$fild] = "Перевищено максимальну кількість символів";
                }
                if ($fild == 'password' && !$validator->matchingLength($value, 255)) {
                    $errors[$fild] = "Перевищено максимальну кількість символів";
                }

            }
        }
        return $errors;
    }
}