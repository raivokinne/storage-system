<?php
namespace App\Controllers;

class ShelvesController {
    public function index() {
        require BASE_PATH . 'views/shelves/index.view.php';
    }
}