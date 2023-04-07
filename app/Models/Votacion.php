<?php
namespace App\Models;

/* The Votacion class is a PHP model that allows for searching and retrieving voting results from a
database. */
class Votacion extends Model
{

	public function __construct()
	{
		parent::__construct('votaciones');
	}

	/**
	 * verifica si un rut ya votó.
	 *
	 * @param rut string
	 * @return boolean
	 */
	public function buscaPorRutVotante($rut)
	{
		$sqlBuscaVotante = 'SELECT COUNT(votaciones.id) as votos FROM votaciones LEFT JOIN votantes ON votantes.id = votaciones.votante_id WHERE votantes.rut = "' . strtoupper($rut) . '"';
		$yaVoto = $this->query($sqlBuscaVotante);
		if ($yaVoto['votos'] != 0) {
			return true;
		}

		return false;
	}

	/**
	 * busca los resultados de las votaciones.
	 * @return array
	 */
	public function getResultados()
	{
		$sqlResultados = 'SELECT candidatos.nombre, COUNT(votaciones.id) as votos FROM candidatos LEFT JOIN votaciones ON candidatos.id = votaciones.candidato_id GROUP BY candidatos.id';
		$resultados = $this->query($sqlResultados);
		return $resultados;
	}
}
