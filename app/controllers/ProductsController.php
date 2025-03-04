<?php
namespace App\Controllers;

class ProductsController {
    public function index(): void {
        view("products/index");
    }
}