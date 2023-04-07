<?php

namespace App\Controllers;

class Controller
{

	/**
	 * revuelve un json para ser consumido
	 *
	 * @param message string
	 * @param data array
	 * @param code integer
	 *
	 * @return json con código, mensaje y data opcional
	 */
	public function response($message, $data = null, $code = 200)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
		header("HTTP/1.1 " . $code . " " . $message);
		header("Content-Type: application/json; charset=utf-8");
		$response = [
			"code" => $code, "message" => $message, "data" => $data
		];
		return json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * muestra respuesta positiva con código 200 por defecto
	 *
	 * @param data array
	 * @param message string
	 * @param code integer
	 */
	public function ok($data = null, $message = 'OK', $code = 200)
	{
		echo $this->response($message, $data, $code);
	}

	/**
	 * muestra respuesta con error con código 422 por defecto
	 *
	 * @param data array
	 * @param message string
	 * @param code integer
	 */
	public function error($message = 'No es posible procesar la petición', $data = null, $code = 422)
	{
		echo $this->response($message, $data, $code);
	}

	/**
	 * muestra no encontrado
	 *
	 * @param message string
	 */
	public function notFound($message = 'No encontrado')
	{
		echo $this->response($message, null, 404);
	}

	/**
	 * muestra error de servidor
	 *
	 * @param message string
	 */
	public function internalServer($message = 'Ha ocurrido un error, intente más tarde')
	{
		echo $this->response($message, null, 500);
	}

	/**
	 * muestra no encontrado (static)
	 *
	 * @param message string
	 */
	public static function returnNotFound($message = 'No encontrado')
	{
		echo self::response($message, null, 404);
	}
}
