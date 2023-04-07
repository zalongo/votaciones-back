<?php

namespace App\Controllers;

use App\Models\Votante;
use App\Models\Votacion;
use App\Helpers\Validator;
use App\Models\ComoConociste;
use App\Models\ComoConocisteVotante;

class VotacionesController extends Controller
{

	/**
	 * guarda una votación
	 *
	 * @return \Controller\response
	 */
	public function guarda()
	{
		if (!$_POST) {
			return $this->notFound();
		}

		try {
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

		return $this->ok(null, 'OK', 201);
	} catch (\Throwable $th) {
		return $this->internalServer($th->getMessage());
	}
	}

	/**
	 * verifica si existe una votación para un rut dado
	 *
	 * @param rut string
	 * @return \Controller\response
	 */
	public function existe($rut = null)
	{
		try {
			$votacionModel = new Votacion;
			if ($votacionModel->buscaPorRutVotante($rut)) {
				return $this->error('Ya existe una votación registrada con este rut');
			}
			return $this->ok();
		} catch (\Throwable $th) {
			return $this->internalServer($th->getMessage());
		}
	}

	/**
	 * devuelve los resultados de las votaciones
	 *
	 * @return \Controller\response
	 */
	public function resultados()
	{
		try {
			$votacionModel = new Votacion;
			$resultados = $votacionModel->getResultados();
			return $this->ok($resultados);
		} catch (\Throwable $th) {
			return $this->internalServer($th->getMessage());
		}
	}
}
