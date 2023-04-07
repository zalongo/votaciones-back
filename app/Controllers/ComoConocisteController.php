<?php

namespace App\Controllers;

use App\Models\ComoConociste;

class ComoConocisteController extends Controller
{
	public function index()
	{
		$ComoConocisteModel = new ComoConociste();
		$como = $ComoConocisteModel->get();
		return $this->ok($como);
	}
}
