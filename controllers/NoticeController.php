<?php namespace Controllers;
class NoticeController {

    protected $userModel = null;
    protected $noticeModel = null;
    protected $loginCheck = null;

    public function __construct($userModel, $noticeModel, $loginCheck)
    {
        $this->userModel = $userModel;
        $this->noticeModel = $noticeModel;
        $this->loginCheck = $loginCheck;
    }

    public function create() {
        $loggedUser = $this->loginCheck->check();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        $success = false;
        if ($method == 'POST') {
            $text = $_POST['text'];
            $userId = $this->userModel->getId($loggedUser);
            if ($this->noticeModel->create($userId, $text)) {
                $success = true;
            } else {
                array_push($errors, 'Something went wrong.');
            }
        }
        require 'views/CreateNoticeView.php';
    }

    public function delete() {
        $loggedUser = $this->loginCheck->check();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        $success = false;
        $notices = [];
        if ($method == 'POST') {
            $userId = $this->userModel->getId($loggedUser);
            $noticeId = $_POST['id'];
            if ($this->noticeModel->delete($userId, $noticeId)) {
                $success = true;
            } else {
                array_push($errors, 'Something went wrong.');
            }
        }
        require 'views/NoticesView.php';
    }

    public function getAll() {
        $loggedUser = $this->loginCheck->check();
        $userId = $this->userModel->getId($loggedUser);
        $errors = [];
        $success = false;
        $notices = $this->noticeModel->showAll($userId);
        require 'views/NoticesView.php';
    }

    public function find() {
        $loggedUser = $this->loginCheck->check();
    }
}