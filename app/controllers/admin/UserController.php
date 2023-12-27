<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use helpers\Session;
use helpers\Validator;
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
        $this->data['title'] = 'Перелік адміністраторів';
        foreach ($user->getUsers() as $user) {
            $this->data['users'][] = [
                'id' => $user['id'],
                'login' => $user['login'],
                'email' => $user['email'],
                'url_edit' => Router::getUrl('user','edit', 'id='.$user['id']),
                'url_destroy' => Router::getUrl('user','destroy', 'id='.$user['id'])
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
        $this->data['title'] = 'Реєстрація нового адміністратора';
        $this->data['text_btn'] = 'Створити';
        $this->data['login'] = '';
        $this->data['email'] = '';
        $this->data['url'] = Router::getUrl('user','store');
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
        $this->data['email'] = filter_var(filter_input(INPUT_POST, 'email'), FILTER_VALIDATE_EMAIL);
        $this->data['password'] = filter_input(INPUT_POST, 'password');
        $this->data['password_confirm'] = filter_input(INPUT_POST, 'password_confirm');

        if (Validator::checkListInput($this->data)) {
            if ($this->data['password'] === $this->data['password_confirm']) {
                $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
                if ($users->create($this->data)) {
                    Router::redirect('index');
                } else {
                    throw new \Exception('Помилка запису у БД');
                }
            }
        } else {
            $error = implode(' | ' , Session::getErrors());
            throw new \Exception($error);
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
        $this->data['title'] = 'Редагування адміністратора';
        $this->data['text_btn'] = 'Зберегти';
        $this->data['url'] = Router::getUrl('user','update');
        $user = new User();
        $getUser = $user->getUserById($id);
        if ($getUser) {
            $this->data['id'] = $getUser['id'];
            $this->data['login'] = $getUser['login'];
            $this->data['email'] = $getUser['email'];
            $this->view->adminRender($page, $this->data);
        } else {
            throw new \Exception('Адмін не знайдений');
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
        $this->data['login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->data['email'] = filter_var(filter_input(INPUT_POST, 'email'), FILTER_VALIDATE_EMAIL);
        if (Validator::checkListInput($this->data)) {
            $this->data['password'] = filter_input(INPUT_POST, 'password');
            $this->data['password_confirm'] = filter_input(INPUT_POST, 'password_confirm');
            if (Validator::checkListInput($this->data)) {
                if ($this->data['password'] === $this->data['password_confirm']) {
                    $this->data['id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                    $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
                    if ($users->update($this->data) && $users->updatePassword($this->data)) {
                        Router::redirect('index');
                    } else {
                        throw new \Exception('Помилка запису у БД');
                    }
                } else {
                    throw new \Exception('Паролі не спвпадають');
                }
            } else {
                $this->data['id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                if ($users->update($this->data)) {
                    Router::redirect('index');
                } else {
                    throw new \Exception('Помилка запису у БД');
                }
            }
        } else {
            $error = implode(' | ' , Session::getErrors());
            throw new \Exception($error);
        }
    }

    /**
     * Видалення адміністратора
     * @return void
     * @throws \Exception
     */
    public function destroy(): void
    {
        $id = filter_input(INPUT_GET, 'id');
        $users = new User();
        if ($users->destroy($id)) {
            Router::redirect('index');
        } else {
            throw new \Exception('Помилка видалення з БД');
        }
    }
}