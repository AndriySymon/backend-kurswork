<?php

namespace controllers;

use core\Controller;
use core\Template;
use core\Core;
use models\Instruments;
use core\DB;

class AdminInstrumentController extends Controller {
    public function actionEdit($params){
        $id = $params[0] ?? null;
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /');
            exit;
        }

        $instrumentModel = new Instruments();
        $instrument = $instrumentModel->findById($id);

        if (!$instrument) {
            http_response_code(404);
            echo "Інструмент не знайдено";
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $short_text = trim($_POST['short_text'] ?? '');
            $price = floatval($_POST['price'] ?? 0);
            $text = trim($_POST['text'] ?? '');
            $image = trim($_POST['image'] ?? '');
            $category_id = intval($_POST['category_id'] ?? 0);

            if (empty($name) || empty($short_text) || $price <= 0) {
                $error = 'Усі поля обовʼязкові, ціна має бути додатною.';
            } else {
                $instrumentModel->update($id, $name, $short_text, $price, $text, $image, $category_id);
                $_SESSION['flash'] = 'Інструмент оновлено!';
                header('Location: /instruments/index');
                exit;
            }
        }

        return $this->render([
            'instrument' => $instrument,
            'error' => $error
        ], 'admin/edit');
    }

    public function actionDelete($params){
         $id = $params[0] ?? null;

        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /');
            exit;
        }

        if ($id !== null) {
            $instrumentModel = new Instruments();
            $instrument = $instrumentModel->findById($id);
            if ($instrument) {
                $instrumentModel->delete($id);
                $_SESSION['flash'] = 'Інструмент видалено.';
            } else {
                $_SESSION['flash'] = 'Інструмент не знайдено.';
            }
        }

        header('Location: /instruments/index');
        exit;
    }

    public function actionAdd($params = []){
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /');
        exit;
        }

        $error = null;
        $instrumentModel = new Instruments();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $short_text = trim($_POST['short_text'] ?? '');
            $price = floatval($_POST['price'] ?? 0);
            $text = trim($_POST['text'] ?? '');
            $image = trim($_POST['image'] ?? '');
            $category_id = intval($_POST['category_id'] ?? 0);

            if (empty($name) || empty($short_text) || $price <= 0) {
                $error = 'Усі поля обовʼязкові, ціна має бути додатною.';
            } else {
                $instrumentModel->add($name, $short_text, $price, $text, $image, $category_id);
                $_SESSION['flash'] = 'Інструмент додано!';
                header('Location: /');
                exit;
            }
        }

        return $this->render([
            'error' => $error
        ], 'admin/add');
    }
}