<?php

namespace Middlewares;

class LoginCheckMiddleware {
    /**
     * @return string
     */
    public function check() {
        $username = $_SESSION['username'];

        if (!isset($username)) {
            header('Location: /login');
            die;
        }

        return $username;
    }

    public function onlyForAnonymous() {
        $username = $_SESSION['username'];

        if (isset($username)) {
            header('Location: /my');
            die;
        }
    }
}