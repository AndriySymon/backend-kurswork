<?php

namespace controllers;

use core\Controller;
use models\Attributes;

class AdminAttributeController extends Controller{
    public function actionAdd($params)
    {
        $instrumentId = $params[0] ?? null;

        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $value = trim($_POST['value'] ?? '');

            if (empty($name) || empty($value)) {
                $error = "Усі поля обов'язкові.";
            } else {
                Attributes::addAttribute($instrumentId, $name, $value);
                header("Location: /instruments/view/$instrumentId");
                exit;
            }
        }

        return $this->render([
            'instrument_id' => $instrumentId,
            'error' => $error
        ], 'admin/attribute_add');
    }

    public function actionEdit($params)
    {
        $attributeId = $params[0] ?? null;

        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $attribute = Attributes::getById($attributeId);
        if (!$attribute) {
            http_response_code(404);
            echo "Атрибут не знайдено";
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $value = trim($_POST['value'] ?? '');

            if (empty($name) || empty($value)) {
                $error = "Усі поля обов'язкові.";
            } else {
                Attributes::updateAttribute($attributeId, $name, $value);
                header("Location: /instruments/view/{$attribute['instrument_id']}");
                exit;
            }
        }

        return $this->render([
            'attribute' => $attribute,
            'error' => $error
        ], 'admin/attribute_edit');
    }

    public function actionDelete($params)
    {
        $attributeId = $params[0] ?? null;

        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $attribute = Attributes::getById($attributeId);
        if ($attribute) {
            Attributes::deleteAttribute($attributeId);
            header("Location: /instruments/view/{$attribute['instrument_id']}");
        } else {
            http_response_code(404);
            echo "Атрибут не знайдено";
        }
        exit;
    }
}