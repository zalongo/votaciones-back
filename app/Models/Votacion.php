<?php
namespace App\Models;

class Votacion extends Model
{

	public function __construct()
	{
		parent::__construct('votaciones');
	}

	public function buscaPorRutVotante($rut)
	{
		$sqlBuscaVotante = 'SELECT COUNT(votaciones.id) as votos FROM votaciones LEFT JOIN votantes ON votantes.id = votaciones.votante_id WHERE votantes.rut = "' . strtoupper($rut) . '"';
		$yaVoto = $this->query($sqlBuscaVotante);
		if ($yaVoto['votos'] != 0) {
			return true;
		}

		return false;
	}

	public function getResultados()
	{
		$sqlResultados = 'SELECT candidatos.nombre, COUNT(votaciones.id) as votos FROM candidatos LEFT JOIN votaciones ON candidatos.id = votaciones.candidato_id GROUP BY candidatos.id';
		$resultados = $this->query($sqlResultados);
		return $resultados;
	}
}
