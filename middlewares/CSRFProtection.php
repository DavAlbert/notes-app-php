<?php

namespace Middlewares;

class CSRFProtectionMiddleware {
    public function check() {
        $key = $_POST['csrf-input'];
        $cookieKey = $_COOKIE['csrf'];

        if (!isset($cookieKey)) {
            echo 'The request was not made from this website. Missing CSRF Cookie.';
            die;
        }

        if ($cookieKey != $key) {
            echo 'The request was not made from this website. Wrong CSRF Cookie.';
            die;
        }
    }

    /**
     * @return string
     */
    public function generateTokenField() {
        $key = sha1(time());
        setcookie('csrf', $key);
        return '<input type="hidden" name="csrf-input" value="' . $key . '"/>';
    }
}