<?php
namespace App\Controllers;

use App\Models\Actions;

class ActionsController {
    public function index(): void {
        Actions::all();
        $actions = Actions::getAll();
        view("actions/index", compact('actions'));
    }
}