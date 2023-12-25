<?php

namespace helpers;

class Session
{
    static public function setErrors(array $errors)
    {
        session_start();
        $_SESSION['errors'] = $errors;

    }

    static public function getErrors()
    {
        session_start();
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            return $errors;
        }
        return [];
    }

    static public function setValue( string $name, $value)
    {
        session_start();
        $_SESSION[$name] = $value;

    }

    static public function getValue(string $name)
    {
        session_start();
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }


    static public function delFromSession($keys=[])
    {
        session_start();
        if(isset($keys)){
            session_destroy();
        }else{
            foreach ($keys as $key){
                if (!isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }

    /**
     * @return bool
     */
    static public function isAuth(): bool
    {
        session_start();

        return !empty($_SESSION['login']);
    }

    /**
     * @return array|null
     */
    static public function getAuthUser(): ?array
    {
        session_start();
        if(empty($_SESSION['login'])){
            return null;
        }
        return $_SESSION['login'];
    }
}