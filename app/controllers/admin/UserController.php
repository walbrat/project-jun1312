<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use helpers\Session;
use core\Validator;
use models\User;

class UserController extends BaseController
{
    /**
     * Перелік адміністраторів
     * @return void
     */
    public function index()
    {
        $user = new User();
        $page = 'user';
        $this->data['title'] = 'List of administrators';
        foreach ($user->getUsers() as $user) {
            if (Session::isAuthRoot()) {
                $url_edit = Router::getUrl('user','edit', 'id='.$user['id']);
                $url_destroy = Router::getUrl('user','destroy', 'id='.$user['id']);
            } else {
                if ($user['id'] != 1) {
                    $url_edit = Router::getUrl('user','edit', 'id='.$user['id']);
                    $url_destroy = Router::getUrl('user','destroy', 'id='.$user['id']);
                } else {
                    $url_edit = "";
                    $url_destroy = "";
                }
            }
            $this->data['users'][] = [
                'id' => $user['id'],
                'login' => $user['login'],
                'email' => $user['email'],
                'url_edit' => $url_edit,
                'url_destroy' => $url_destroy
            ];
        }
        $this->data['url_create'] = Router::getUrl('user','create');
        $this->view->adminRender($page, $this->data);
    }

    /**
     * Реєстрація нового адміністратора
     * @return void
     */
    public function create(): void
    {
        $page = 'user_form';
        $this->data['title'] = 'Registration of a new administrator';
        $this->data['text_btn'] = 'Create';
        $this->data['text_btn_cancel'] = 'Cancel';
        $this->data['login'] = Session::getValue('login');
        $this->data['email'] = Session::getValue('email');
        $this->data['password'] = Session::getValue('password');
        $this->data['password_confirm'] = Session::getValue('password_confirm');
        $this->data['errors'] = Session::getErrors();
        $this->data['url'] = Router::getUrl('user','store');
        $this->data['url_cancel'] = Router::getUrl('user','index');
        Session::delFromSession($this->data);
        $this->view->adminRender($page, $this->data);
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
                Router::redirect('index');
            } else {
                throw new \Exception('Error writing in the database');
            }
        } else {
            Session::setErrors($doValidation);
            Router::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Вивести форму Редагування адміністратора
     * @return void
     * @throws \Exception
     */
    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id');
        $page = 'user_form';
        $this->data['title'] = 'Admin edit';
        $this->data['text_btn'] = 'Save';
        $this->data['text_btn_cancel'] = 'Cancel';
        $this->data['url'] = Router::getUrl('user','update');
        $this->data['url_cancel'] = Router::getUrl('user','index');
        $this->data['password'] = Session::getValue('password');
        $this->data['password_confirm'] = Session::getValue('password_confirm');
        $this->data['errors'] = Session::getErrors();
        Session::delFromSession($this->data);
        $user = new User();
        $getUser = $user->getUserById($id);
        if ($getUser) {
            $this->data['id'] = $getUser['id'];
            Session::setValue('login', $getUser['login']);
            Session::setValue('email', $getUser['email']);
            $this->data['login'] = Session::getValue('login');
            $this->data['email'] = Session::getValue('email');
            Session::delFromSession($this->data);
            $this->view->adminRender($page, $this->data);
        } else {
            throw new \Exception('Admin not found');
        }
    }

    /**
     * Обробка форми редагування адміністратора
     * @return void
     * @throws \Exception
     */
    public function update(): void
    {
        $users = new User();
        $this->data['id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->data['login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->data['email'] = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        foreach ($this->data as $key => $value) {
            Session::setValue($key, $value);
        }
        $doValidation = $this->doValidation($this->data);
        if (empty($doValidation)) {
            $this->data['password'] = filter_input(INPUT_POST, 'password');
            $this->data['password_confirm'] = filter_input(INPUT_POST, 'password_confirm');
            foreach ($this->data as $key => $value) {
                Session::setValue($key, $value);
            }
            $doValidation = $this->doValidation($this->data);
            if (empty($doValidation)) {
                $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
                if ($users->update($this->data) && $users->updatePassword($this->data)) {
                    Session::delFromSession($this->data);
                    Router::redirect('index');
                } else {
                    throw new \Exception('Error writing in the database');
                }
            } else {
                if (empty($this->data['password']) && empty($this->data['password_confirm'])) {
                    if ($users->update($this->data)) {
                        Session::delFromSession($this->data);
                        Router::redirect('index');
                    } else {
                        throw new \Exception('Error writing in the database');
                    }
                } else {
                    Session::setErrors($doValidation);
                    Router::redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            Session::setErrors($doValidation);
            Router::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Видалення адміністратора
     * @return void
     * @throws \Exception
     */
    public function destroy(): void
    {
        $users = new User();
        $this->data['id'] = filter_input(INPUT_GET, 'id');
        if ($users->destroy($this->data)) {
            Router::redirect('index');
        } else {
            throw new \Exception('Error deleting from DB');
        }
    }

    /**
     * @param array $filds
     * @return array
     */
    protected function doValidation(array $filds) : array
    {
        $users = new User();
        $errors = [];
        $password = '';
        $password_confirm = '';
        $id = '';
        $validator = new Validator();
        foreach ($filds as $fild => $value) {
            if (empty($value)) {
                $errors[$fild] = "Поле має бути заповнене.";
            } else {
                if ($fild == 'id') {
                    $id = $value;
                    $admin = $users->getUserById($id);
                }
                if ($fild == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$fild] = "Введіть коректний E-mail.";
                }
                if ($fild == 'login' && !$validator->matchingLength($value, 100)) {
                    $errors[$fild] = "Перевищено максимальну кількість символів";
                }
                if ($fild == 'email' && !$validator->matchingLength($value, 100)) {
                    $errors[$fild] = "Перевищено максимальну кількість символів";
                }
                if (empty($id) && $fild == 'email' && !empty($users->getUserByEmail($value))) {
                    $errors[$fild] = "E-mail {$value} вже зареєстрований.";
                }
                if (empty($id) && $fild == 'login' && !empty($users->getUserByLogin($value))) {
                    $errors[$fild] = "Login {$value} вже зареєстрований.";
                }
                if (!empty($id) && $fild == 'email' && $admin['email'] != $value) {
                    if (!empty($users->getUserByEmail($value))) {
                        $errors[$fild] = "E-mail {$value} вже зареєстрований.";
                    }
                }
                if (!empty($id) && $fild == 'login' && $admin['login'] != $value) {
                    if (!empty($users->getUserByLogin($value))) {
                        $errors[$fild] = "Login {$value} вже зареєстрований.";
                    }
                }
                if ($fild == 'password') {
                    $password = $value;
                }
                if ($fild == 'password_confirm') {
                    $password_confirm = $value;
                }
            }
        }
        if (empty($id) && empty($password) && empty($password_confirm)) {
            $errors['password'] = "Введіть пароль";
            $errors['password_confirm'] = "Введіть пароль ще раз для підтвердження";
        }
        if (empty($password) && !empty($password_confirm)) {
            $errors['password'] = "Введіть пароль";
        }
        if (!empty($password) && empty($password_confirm)) {
            $errors['password_confirm'] = "Введіть пароль ще раз для підтвердження";
        }
        if (!empty($password) && !empty($password_confirm) && $password !== $password_confirm) {
            $errors['password'] = "Паролі не співпадають";
            $errors['password_confirm'] = "Паролі не співпадають";
        }
        return $errors;
    }
}