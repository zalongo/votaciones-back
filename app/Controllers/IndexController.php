<?php

namespace App\Controllers;

class IndexController extends Controller
{

	public function index()
	{
		return $this->ok(null, 'Index');
	}
}
