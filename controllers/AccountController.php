<?php
namespace controllers;

use core\Controller;
use core\Template;
use core\Core;
use models\User;

class AccountController extends Controller{
    public function actionProfile(){
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit;
        }

        $userModel = new User();
        $userId = $_SESSION['user']['id'];
        $user = $userModel->findById($userId);
        $error = null;

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if (empty($firstName) || empty($lastName) || empty($email)) {
                $error = "Всі поля обов'язкові.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Невірний формат email.";
            } else {
                $success = $userModel->update($userId, $firstName, $lastName, $email);

                if ($success){
                    $_SESSION['user']['first_name'] = $firstName;
                    $_SESSION['user']['last_name'] = $lastName;
                    $_SESSION['user']['email'] = $email;

                    $_SESSION['flash'] = 'Дані оновлено!';
                    header('Location: /account/profile');
                    exit;
                } else{
                    $error = "Помилка при оновленні!";
                }
            }
        }
        return $this->render([
            'user' => $user,
            'error' => $error
        ], 'account/profile');
    }
    public function actionDelete(){
        if(!isset($_SESSION['user'])){
            header('Location: /auth/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $userModel = new \models\User();

        if($userModel->deleteById($userId)){
            session_destroy();
            header('Location: /');
            exit;
        } else {
            $_SESSION['flash'] = 'Помилка при видаленні акаунту!';
            header('Location: /account/profile');
            exit;
        }
    }
}