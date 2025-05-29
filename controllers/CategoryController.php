<?php
namespace controllers;

use core\Controller;
use core\Template;
use models\Category;
use core\Core;

class CategoryController {
    public function actionView($params) {
    $id = $params[0];
    $instruments = Category::getInstrumentsByCategory($id);
    $categoryName = Category::getCategoryName($id);

    $viewTemplate = new Template("views/category/index.php", [
    'instruments' => $instruments,
    'categoryName' => $categoryName
]);


    \core\Core::get()->template->setParams([
        'instruments' => $instruments,
        'categoryName' => $categoryName
    ]);

    $mainTemplate = Core::get()->template;
    $mainTemplate->setLayout(Core::get()->defaultLayoutPath);
    $mainTemplate->setParams([
        'Content' => $viewTemplate->getHTML(),
        'Title' => 'Категорія: ' . $categoryName
    ]);
}
public function actionAllcategories()
{
    $categories = \models\Category::getAll();

    $viewTemplate = new \core\Template('views/category/allcategories.php', [
        'categories' => $categories
    ]);

    \core\Core::get()->template->setParams([
        'Content' => $viewTemplate->getHTML(),
        'Title' => 'Категорії'
    ]);
}

}
