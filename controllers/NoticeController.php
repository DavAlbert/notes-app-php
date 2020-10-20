<?php

namespace Controllers;

use Middlewares\CSRFProtectionMiddleware;
use Middlewares\LoginCheckMiddleware;
use Models\NoticeModel;
use Models\UserModel;

class NoticeController {
    /**
     * @var UserModel $userModel
     */
    protected $userModel;

    /**
     * @var NoticeModel $noticeModel
     */
    protected $noticeModel;

    /**
     * @var LoginCheckMiddleware $loginCheck
     */
    protected $loginCheck;

    /**
     * @var CSRFProtectionMiddleware $csrfCheck
     */
    protected $csrfCheck;

    /**
     * NoticeController constructor.
     *
     * @param UserModel $userModel
     * @param NoticeModel $noticeModel
     * @param LoginCheckMiddleware $loginCheck
     * @param CSRFProtectionMiddleware $csrfCheck
     */
    public function __construct($userModel, $noticeModel, $loginCheck, $csrfCheck)
    {
        $this->userModel = $userModel;
        $this->noticeModel = $noticeModel;
        $this->loginCheck = $loginCheck;
        $this->csrfCheck = $csrfCheck;
    }

    public function create() {
        $loggedUser = $this->loginCheck->check();
        $method = $_SERVER['REQUEST_METHOD'];
        $errors = [];
        $success = false;
        $csrfInputField = $this->csrfCheck->generateTokenField();

        if ($method == 'POST') {
            $this->csrfCheck->check();
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

            //$this->csrfCheck->check();
            //TODO: The token in the cookie is different! Need to be fixed.

            if ($this->noticeModel->delete($userId, $noticeId)) {
                $success = true;
            } else {
                array_push($errors, 'Something went wrong.');
            }
        }

        header('Location: /notices');
    }

    public function getAll() {
        $loggedUser = $this->loginCheck->check();
        $userId = $this->userModel->getId($loggedUser);
        $errors = [];
        $success = false;
        $notices = $this->noticeModel->showAll($userId);
        $csrfInputField = $this->csrfCheck->generateTokenField();

        require 'views/NoticesView.php';
    }

    public function find() {
        $loggedUser = $this->loginCheck->check();
    }
}