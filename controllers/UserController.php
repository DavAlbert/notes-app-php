<?php namespace Controllers;

class UserController {

    protected $userModel = null;
    protected $loginCheck = null;

    public function __construct($userModel, $loginCheck)
    {
        $this->userModel = $userModel;
        $this->loginCheck = $loginCheck;
    }

    public function register()
    {
        $this->loginCheck->onlyForAnonymous();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        if ($method == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (isset($username) && isset($password) && sizeof($errors) == 0) {
                $data = $this->userModel->register($username, $password);
                if ($data) {
                    $_SESSION['username'] = $username;
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
        if ($method == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (isset($username) && isset($password)) {
                $data = $this->userModel->login($username, $password);
                if ($data) {
                    $_SESSION['username'] = $username;
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
        $success = false;
        if ($method == 'POST') {
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