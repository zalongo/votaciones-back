<?php

namespace App\Controllers;

use App\Models\Comuna;

class ComunasController extends Controller
{
	public function region($regionId = null)
	{
		$ComunaModel = new Comuna();
		$comunasByRegion = $ComunaModel->where('region_id', $regionId)->orderBy('nombre')->get();
		return $this->ok($comunasByRegion);
	}
}
