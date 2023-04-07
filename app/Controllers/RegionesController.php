<?php

namespace App\Controllers;

use App\Models\Region;

class RegionesController extends Controller
{
	public function index()
	{
		$RegionModel = new Region();
		$regiones = $RegionModel->get();
		return $this->ok($regiones);
	}
}
