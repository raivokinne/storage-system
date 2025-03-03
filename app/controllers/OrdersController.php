<?php
namespace App\Controllers;

class OrdersController {
    public function index() {
        require BASE_PATH . 'views/orders/index.view.php';
    }
}