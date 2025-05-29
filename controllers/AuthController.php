<?php
namespace controllers;

use core\DB;
use core\Controller;
class AuthController extends Controller {
    public function actionSignup() {
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordConfirm)) {
            $error = "Будь ласка, заповніть усі поля.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Некоректна електронна пошта.";
        } elseif (strlen($password) < 6) {
            $error = "Пароль має містити щонайменше 6 символів.";
        } elseif ($password !== $passwordConfirm) {
            $error = "Паролі не співпадають.";
        }

        if (!$error) {
            $db = DB::getConnection();
            $userModel = new \models\User();
            $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $userModel->create($firstName, $lastName, $email, $password);

                $user = $userModel->findByEmail($email);

                $_SESSION['user'] = $user;

                $_SESSION['flash'] = "Реєстрація успішна!";
                header('Location: /');
                exit;

            } catch (\PDOException $e) {
                $error = "Користувач з такою поштою вже існує.";
            }
        }
    }

    return $this->render(['error' => $error ?? null]);
}

    public function actionLogout() {
        unset($_SESSION['user']);
        header('Location: /');
        exit;
    }

    public function actionLogin()
    {
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = "Будь ласка, заповніть усі поля.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Некоректна електронна пошта.";
        } else {
            $userModel = new \models\User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                unset($_SESSION['cart']);
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'role' => $user['role'],
                ];
                $_SESSION['flash'] = 'Ви успішно увійшли!';
                header('Location: /');
                exit;
            } else {
                $error = 'Невірна пошта або пароль.';
            }
        }
    }
    return $this->render([
    'Title' => 'Вхід',
    'error' => $error ?? null
], 'auth/login');
}
}