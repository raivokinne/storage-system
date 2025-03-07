<?php
namespace App\Controllers;

class OrdersController {
    public function index(): void {
        view('orders/index');
    }
}
