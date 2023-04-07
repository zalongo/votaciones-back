<?php

namespace App\Controllers;

class IndexController
{

	public function index()
	{
		return $this->ok(null, 'Index');
	}
}
