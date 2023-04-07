<?php

namespace App\Controllers;

use App\Models\Votante;

class VotantesController extends Controller
{
	public function index()
	{
		return $this->ok(null, 'Votantes');
	}
}
