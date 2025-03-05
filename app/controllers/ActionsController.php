<?php
namespace App\Controllers;

use App\Models\Actions;

class ActionsController {
    public function index() {
        $actions = Actions::all()->getAll();
        return view('actions/index', ['actions' => $actions]);
    }
}