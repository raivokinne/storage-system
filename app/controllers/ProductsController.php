<?php
namespace App\Controllers;

class ProductsController {
    public function index() {
        require BASE_PATH . 'views/products/index.view.php';
    }
}