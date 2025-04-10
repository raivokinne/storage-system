<?php
namespace App\Controllers;

use App\Models\Action;

class ActionsController {
    public function index(): void {
        Action::all();
        $actions = Action::getAll();
        view("actions/index", compact('actions'));
    }
}