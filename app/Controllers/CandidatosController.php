<?php

namespace App\Controllers;

use App\Models\Candidato;


class CandidatosController extends Controller
{

	public function index()
	{
		$CandidatoModel = new Candidato();
		$candidatos = $CandidatoModel->get();
		return $this->ok($candidatos);
	}
}
