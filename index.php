<?php
 error_reporting(0);

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use App\Controllers\Controller;
use App\Controllers\IndexController;
use App\Controllers\ComunasController;
use App\Controllers\RegionesController;
use App\Controllers\VotantesController;
use App\Controllers\CandidatosController;
use App\Controllers\VotacionesController;
use App\Controllers\ComoConocisteController;


$url = $_SERVER['REQUEST_URI'];

// Eliminar la barra diagonal inicial de la URL
$url =explode('/', ltrim($url, '/'));
$class = isset($url[0]) ? $url[0] : null;
$method_class = isset($url[1]) ? $url[1] : 'index';
$param = isset($url[2]) ? $url[2] : null;
$controller = null;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
function env($key)
{
	return	$_ENV[$key];
}


// Llamar a la función correspondiente en función de la URL
switch ($class) {
	case null:
		$controller = new IndexController;
	case 'votacion':
		$controller = new VotacionesController;
		break;
	case 'candidato':
		$controller = new CandidatosController;
		break;
	case 'region':
		$controller = new RegionesController;
		break;
	case 'comuna':
		$controller = new ComunasController;
		break;
	case 'votante':
		$controller = new VotantesController;
		break;
	case 'como-conociste':
		$controller = new ComoConocisteController;
		break;
    default:
        Controller::returnNotFound();
        break;
}

if( method_exists($controller, $method_class)){

	if ($param) {
		$controller->$method_class($param);
	}else{
		$controller->$method_class();
	}
}else{
	Controller::returnNotFound();
}
