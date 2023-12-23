<?php

namespace controllers\admin;

use core\BaseController;
use core\Router;
use core\View;
use models\User;


class AdminController extends BaseController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $page = 'index';
        $this->data['title'] = 'Адмін панель';
        $this->checkRootUser();
        $this->view->adminRender($page, $this->data);
    }

    /**
     * Цей метод перевіряє існування файла install.php, та чи є в базі даних користувачі.
     * @return mixed
     */
    public function checkRootUser(): mixed
    {
        $page = 'install';
        $installFile = ADMIN_PAGES_FOLDER . $page . '.php';
        $users = new User();
        $allUsers = $users->getUsers();

        if (file_exists($installFile) && empty($allUsers)) {
            $url = Router::getUrl('install', 'index');
            Router::redirect($url);
        } else if (!empty($allUsers)) {
            $installTemplateFile = TEMPLATES_ADMIN_FOLDER . $page . '_template.php';
            $installControllerFile =  __DIR__ . DIRECTORY_SEPARATOR . ucfirst($page) . 'Controller.php';
            if (file_exists($installFile)) {
                unlink($installFile);
            }
            if (file_exists($installTemplateFile)) {
                unlink($installTemplateFile);
            }
            if (file_exists($installControllerFile)) {
                unlink($installControllerFile);
            }
        }
        return false;
    }
}