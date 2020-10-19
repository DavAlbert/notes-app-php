<?php

use Middlewares\LoginCheckMiddleware;
use Models\UserModel;
use Models\NoticeModel;

session_start();

$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
$uri = explode('/', $request);


require_once "lib/Database.php";

require_once "models/UserModel.php";
require_once "models/NoticeModel.php";

require_once "controllers/UserController.php";
require_once "controllers/NoticeController.php";

require_once "middlewares/LoginCheck.php";

$db = new Database();
$loginCheck = new LoginCheckMiddleware();
$userModel = new UserModel($db);
$noticeModel = new NoticeModel($db);

$Controllers = [
    'user' => new Controllers\UserController($userModel, $loginCheck),
    'notice' => new Controllers\NoticeController($userModel, $noticeModel, $loginCheck)
];

switch ($uri[0]) {
    case 'login':
        $Controllers['user']->login();
        break;
    case 'register':
        $Controllers['user']->register();
        break;
    case 'change-password':
        $Controllers['user']->resetPassword();
        break;
    case 'my':
        $Controllers['user']->my();
        break;
    case 'logout':
        $Controllers['user']->logout();
        break;
    case 'notices':
        if (sizeof($uri) == 1) {
            $Controllers['notice']->getAll();
        } else {
            $action = $uri[1];
            switch ($action) {
                case 'create':
                    $Controllers['notice']->create();
                    break;
                case 'delete':
                    $Controllers['notice']->delete();
                    break;
                default:
                    header('Location: /notice');
                    die;
            }
        }
        break;
    default:
        header('Location: /login');
        die;
}