<?php

namespace App\Controllers;

use App\Models\Comuna;

class ComunasController extends Controller
{
	/**
	 * devuelve las comunas para una región dada
	 *
	 * @param regionId integer
	 * @return \Controller\response
	 */
	public function region($regionId = null)
	{
		try {
			$ComunaModel = new Comuna();
			$comunasByRegion = $ComunaModel->where('region_id', $regionId)->orderBy('nombre')->get();
			return $this->ok($comunasByRegion);
		} catch (\Throwable $th) {
			return $this->internalServer($th->getMessage());
		}
	}
}
