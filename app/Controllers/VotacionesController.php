<?php

namespace App\Controllers;

use App\Models\Votante;
use App\Models\Votacion;
use App\Helpers\Validator;
use App\Models\ComoConociste;
use App\Models\ComoConocisteVotante;

class VotacionesController extends Controller
{

	public function guarda()
	{
		if (!$_POST) {
			return $this->notFound();
		}

		$rules = [
			'rut'            => ['required', 'rut'],
			'nombre'         => ['required', 'name'],
			'alias'          => ['required', 'minlength' => 5, 'alphanumeric'],
			'email'          => ['required', 'email'],
			'region_id'      => ['required'],
			'comuna_id'      => ['required'],
			'candidato'      => ['required'],
			'como_conociste' => ['required', 'array', 'minlength' => 2]
		];

		$data = $_POST;

		$validator = new Validator($data, $rules);
		if (!$validator->isValid()) {
			return $this->error(null, $validator->getErrors());
		}

		$votacionModel = new Votacion;
		if ($votacionModel->buscaPorRutVotante($data['rut'])) {
			return $this->error('Ya existe una votación registrada con este rut');
		}

		$votanteModel = new Votante;
		$dataVotante  = [
			'nombre'    => $data['nombre'],
			'alias'     => $data['alias'],
			'rut'       => strtoupper(str_replace('-', '', str_replace('.', '', $data['rut']))),
			'email'     => $data['email'],
			'region_id' => $data['region_id'],
			'comuna_id' => $data['comuna_id'],
		];
		$votanteId = $votanteModel->create($dataVotante);

		$dataVotacion = [
			'candidato_id' => $data['candidato'],
			'votante_id' => $votanteId
		];
		$votacionModel->create($dataVotacion);

		$comoConocisteModel = new ComoConocisteVotante;
		foreach ($data['como_conociste'] as $comoId) {
			$comoConocisteModel->create([
				'como_conociste_id' => $comoId,
				'votante_id' => $votanteId
			]);
		}

		return $this->ok();
	}

	public function existe($rut = null)
	{
		$votacionModel = new Votacion;
		if ($votacionModel->buscaPorRutVotante($rut)) {
			return $this->error('Ya existe una votación registrada con este rut');
		}
		return $this->ok();
	}

	public function resultados()
	{
		$votacionModel = new Votacion;
		$resultados = $votacionModel->getResultados();
		return $this->ok($resultados);
	}
}
