<?php
namespace App\Controllers;

class ShelvesController {
    public function index(): void {
        view("shelves/index");
    }
}