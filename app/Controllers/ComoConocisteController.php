<?php

namespace App\Controllers;

use App\Models\ComoConociste;

class ComoConocisteController extends Controller
{
	/**
	 * devuelve todas las opciones de cómo nos conociste
	 *
	 * @return \Controller\response
	 */
	public function index()
	{
		try {
			$ComoConocisteModel = new ComoConociste();
			$como = $ComoConocisteModel->get();
			return $this->ok($como);
		} catch (\Throwable $th) {
			return $this->internalServer($th->getMessage());
		}
	}
}
