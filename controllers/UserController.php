<?php

namespace Controllers;

use Middlewares\CSRFProtectionMiddleware;
use Middlewares\LoginCheckMiddleware;
use Models\UserModel;

class UserController {
    /**
     * @var UserModel $userModel
     */
    protected $userModel;

    /**
     * @var LoginCheckMiddleware $loginCheck
     */
    protected $loginCheck;

    /**
     * @var CSRFProtectionMiddleware $csrfCheck
     */
    protected $csrfCheck;

    /**
     * UserController constructor.
     *
     * @param UserModel $userModel
     * @param LoginCheckMiddleware $loginCheck
     * @param CSRFProtectionMiddleware $csrfCheck
     */
    public function __construct($userModel, $loginCheck, $csrfCheck)
    {
        $this->userModel = $userModel;
        $this->loginCheck = $loginCheck;
        $this->csrfCheck = $csrfCheck;
    }

    public function register()
    {
        $this->loginCheck->onlyForAnonymous();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        $csrfInputField = $this->csrfCheck->generateTokenField();

        if ($method == 'POST') {
            $this->csrfCheck->check();
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isset($username) && isset($password) && sizeof($errors) == 0) {
                $data = $this->userModel->register($username, $password);

                if ($data) {
                    $_SESSION['username'] = $username;
                    session_regenerate_id();
                    header('Location: /my');
                    die;
                }

                array_push($errors, 'Your username or password is invalid.');
            }
        }

        require 'views/RegisterView.php';
    }

    public function login()
    {
        $this->loginCheck->onlyForAnonymous();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        $csrfInputField = $this->csrfCheck->generateTokenField();

        if ($method == 'POST') {
            $this->csrfCheck->check();
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isset($username) && isset($password)) {
                $data = $this->userModel->login($username, $password);

                if ($data) {
                    $_SESSION['username'] = $username;
                    session_regenerate_id();
                    header('Location: /my');
                    die;
                }

                array_push($errors, 'Your username or password is not correct.');
            }
        }

        require 'views/LoginView.php';
    }

    public function resetPassword()
    {
        $loggedUser = $this->loginCheck->check();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        $success = $this->csrfCheck->generateTokenField();
        $csrfInputField = $this->csrfCheck->generateTokenField();

        if ($method == 'POST') {
            $this->csrfCheck->check();
            $password = $_POST['password'];
            $data = $this->userModel->changePassword($loggedUser, $password);

            if ($data) {
                $success = true;
            } else {
                array_push($errors, 'Something went wrong.');
            }

            require 'views/MyView.php';
            die;
        }

        header('Location: /my');
    }

    public function my()
    {
        $csrfInputField = $this->csrfCheck->generateTokenField();
        $loggedUser = $this->loginCheck->check();
        $errors = [];
        require 'views/MyView.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        die;
    }
}