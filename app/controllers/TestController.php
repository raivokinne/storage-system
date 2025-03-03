<?php

namespace App\Controllers;

class TestController extends Controller
{
	public function index()
	{
		view('test');
	}
    public function store()
    {
        dd(request('image'));
    }
}
