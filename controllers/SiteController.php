<?php
namespace controllers;

use core\Controller;
use core\Template;
use core\DB;
use models\ReviewModel;

class SiteController extends Controller{
    public function actionIndex(){
        $reviewModel = new ReviewModel(DB::getConnection());
        $reviews = $reviewModel->getLatestReviews(4);
        $template = new Template('views/site/index.php', [
            'reviews' => $reviews
        ]);
        return [
            'Content' => $template->getHTML(),
            'Title' => 'Головна сторінка'
        ];
    }
    public function actionError($code){
        echo $code;
    }
    public function actionAbout() {
    $template = new \core\Template('views/site/about.php');
    return [
        'Content' => $template->getHTML(),
        'Title' => 'Про магазин'
    ];
}
}