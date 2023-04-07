<?php

namespace App\Controllers;

use App\Models\Region;

class RegionesController extends Controller
{
	/**
	 * devuelve todas las regiones
	 *
	 * @return \Controller\response
	 */
	public function index()
	{
		try {
			$RegionModel = new Region();
			$regiones = $RegionModel->get();
			return $this->ok($regiones);
		} catch (\Throwable $th) {
			return $this->internalServer($th->getMessage());
		}
	}
}
