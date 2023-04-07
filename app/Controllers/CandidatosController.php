<?php

namespace App\Controllers;

use App\Models\Candidato;


class CandidatosController extends Controller
{

	/**
	 * devuelve todos los candidatos
	 *
	 * @return \Controller\response
	 */
	public function index()
	{
		try {
			$CandidatoModel = new Candidato();
			$candidatos = $CandidatoModel->get();
			return $this->ok($candidatos);
		} catch (\Throwable $th) {
			return $this->internalServer($th->getMessage());
		}
	}
}
