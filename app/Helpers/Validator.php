<?php

namespace App\Helpers;

class Validator
{

	private $valid, $errors, $data, $rules;

	public function __construct($data, $rules)
	{
		$this->data = $data;
		$this->rules = $rules;
		$this->valid = true;
		$this->makeValidation();
	}

	public function makeValidation()
	{
		foreach ($this->data as $key => $value) {
			if (isset($this->rules[$key])) {
				foreach ($this->rules[$key] as $rule => $filter) {
					if(is_numeric($rule)){
						$rule = $filter;
						if (method_exists($this, $rule)) {
							$this->$rule($key, $value);
						}
					}else{
						if (method_exists($this, $rule)) {
							$this->$rule($key, $value, $filter);
						}
					}
				}
			}
		}
	}

	public function setError($key, $error)
	{
		$this->errors[$key][] = $error;
	}

	public function isValid()
	{
		return $this->valid;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function required($key, $value)
	{
		if(is_string($value)){
			$value = trim($value);
		}
		if (empty($value)) {
			$this->valid = false;
			$this->setError($key, "El campo $key es obligatorio");
			return false;
		}
		return true;
	}

	public function name($key, $value)
	{
		if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]*$/", $value)) {
			$this->valid = false;
			$this->setError($key, "El campo $key sólo puede contener letras y espacios");
			return false;
		}
		return true;
	}

	public function rut($key, $value)
	{
		// Limpia el RUT de cualquier caracter no numérico excepto K/k.
		$value = preg_replace('/[^0-9Kk]/', '', $value);

		// Si la cadena tiene menos de 8 dígitos, no es un RUT válido.
		if (strlen($value) < 8) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un rut válido");
			return false;
		}

		// Separa el dígito verificador del RUT.
		$dv = strtoupper(substr($value, -1));
		$numero = substr($value, 0, -1);

		// Calcula el dígito verificador utilizando el algoritmo modificado de Verhoeff.
		$sum = 0;
		$factor = 2;

		for ($i = strlen($numero) - 1; $i >= 0; $i--) {
			$sum += $factor * intval($numero[$i]);
			$factor = $factor == 7 ? 2 : $factor + 1;
		}

		$dv_calculado = 11 - ($sum % 11);

		if ($dv_calculado == 10) {
			$dv_calculado = 'K';
		}

		if ($dv_calculado == 11) {
			$dv_calculado = '0';
		}

		// Compara el dígito verificador calculado con el dígito verificador dado.
		if($dv != $dv_calculado){
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un rut válido");
			return false;
		}
		return true;
	}


	public function email($key, $value)
	{
		$value = trim($value);
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un email válido");
			return false;
		}
		return true;
	}


	public function array($key, $value)
	{
		if (!is_array($value)) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un arreglo");
			return false;
		}
		return true;
	}

	public function minlength($key, $value, $filter)
	{
		if (is_array($value) && count($value) < $filter) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe tener al menos $filter elementos");
			return false;
		}

		if (is_string($value) && strlen($value) < $filter) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe tener al menos $filter caracteres");
			return false;
		}
	}

	public function alphanumeric($key, $value)
	{
		if (!preg_match("/^[a-zA-Z0-9áéíóúüñÁÉÍÓÚÜÑ]*$/", $value)) {
			$this->valid = false;
			$this->setError($key, "El campo $key sólo puede contener letras y números");
			return false;
		}
		return true;
	}

}
