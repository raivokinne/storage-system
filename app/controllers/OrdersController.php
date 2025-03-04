<?php
namespace App\Controllers;

class OrdersController {
    public function index(): void {
        view('order/index');
    }
}