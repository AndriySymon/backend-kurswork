<?php
namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\Category;

class AdminCategoryController extends Controller{
    public function actionIndex(){
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /auth/login');
            exit;
        }

        $categories = Category::getAll();

        $view = new Template('views/admin/allcategories.php', [
            'categories' => $categories
        ]);

        Core::get()->template->setParams([
            'Title' => 'Редагування категорій',
            'Content' => $view->getHTML()
        ]);
    }

    public function actionEdit($params){
        $id = $params[0];
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST['name'];
            $short_text = $_POST['short_text'];

            $category = Category::getById($id);
            $image = $_POST['image'];

            if (!empty($image) && !file_exists('images/' . $image)) {
                $error = "Файл зображення '{$image}' не знайдено у папці images.";
            }

            if (!$error) {
                Category::update($id, $name, $short_text, $image);
                header('Location: /admincategory/index');
                exit;
            }

            Category::update($id, $name, $short_text, $image);
            header('Location: /admincategory/index');
            exit;
        }
        $category = Category::getById($id);

        $view = new Template('views/admin/editcategories.php', [
            'category' => $category,
            'error' => $error ?? null,
            'name' => $_POST['name'] ?? $category['name'],
            'short_text' => $_POST['short_text'] ?? $category['short_text'],
            'image' => $_POST['image'] ?? $category['image'],
        ]);

        Core::get()->template->setParams([
            'Title' => 'Редагувати категорію',
            'Content' => $view->getHTML()
        ]);
    }

    public function actionDelete($params){
        $id = $params[0];
        Category::delete($id);
        header('Location: /admincategory/index');
        exit;
    }

    public function actionAdd(){
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $short_text = $_POST['short_text'];
        $image = $_POST['image'];

        if (!file_exists('images/' . $image)) {
            $error = "Файл зображення '$image' не знайдено у папці images.";
        }

        if (!$error) {
            Category::add($name, $short_text, $image);
            header('Location: /admincategory/index');
            exit;
        }
    }

        $view = new Template('views/admin/addcategory.php', [
            'error' => $error,
            'name' => $_POST['name'] ?? '',
            'short_text' => $_POST['short_text'] ?? '',
            'image' => $_POST['image'] ?? '',
        ]);

        Core::get()->template->setParams([
            'Content' => $view->getHTML()
        ]);
    }
}