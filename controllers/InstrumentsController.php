<?php

namespace controllers;

use core\Controller;
use core\Template;
use core\DB;
use models\Instruments;

class InstrumentsController extends Controller{
    public function actionAdd(){
        return $this->render();
    }

    public function actionIndex(){
        return $this->render();
    }
    public function actionView($params) {
    $id = isset($params[0]) ? intval($params[0]) : 0;
    if ($id <= 0) die("Невірний ID.");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $author = $_POST['author'] ?? '';
        $city = $_POST['city'] ?? '';
        $content = $_POST['content'] ?? '';
        if ($author && $city && $content) {
            Instruments::addReview($id, $author, $city, $content);
        }
    }

    $instrument = Instruments::getById($id);
    if (!$instrument) die("Інструмент не знайдено.");

    $attributes = Instruments::getAttributes($id);
    $reviews = Instruments::getReviews($id);

    $template = new \core\Template('views/instruments/view.php', [
        'instrument' => $instrument,
        'attributes' => $attributes,
        'reviews' => $reviews
    ]);

    return [
        'Content' => $template->getHTML(),
        'Title' => 'Деталі інструменту'
    ];
}
}