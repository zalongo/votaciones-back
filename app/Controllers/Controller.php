<?php

namespace App\Controllers;

class Controller
{

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

	public function ok($data = null, $message = 'OK')
	{
		echo $this->response($message, $data, 200);
	}

	public function error($message = 'No es posible procesar la petición', $data = null, $code = 422)
	{
		echo $this->response($message, $data, $code);
	}

	public function notFound($message = 'No encontrado')
	{
		echo $this->response($message, null, 404);
	}

	public function forbidden($message = 'Ha ocurrido un error, intente más tarde')
	{
		echo $this->response($message, null, 403);
	}

	public static function returnNotFound($message = 'No encontrado')
	{
		echo self::response($message, null, 404);
	}
}
