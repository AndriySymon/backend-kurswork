<?php
namespace controllers;

use core\Controller;
use core\Template;
use models\Category;
use core\Core;

class HomeController extends Controller {
    public function index() {
        $reviewModel = new ReviewModel($this->db);
        $latestReviews = $reviewModel->getLatestReviews();

        $this->view('home/index', [
            'Title' => 'Головна сторінка',
            'reviews' => $latestReviews
        ]);
    }
}
