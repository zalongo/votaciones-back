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

	/**
	 * valida la data
	 */
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

	/**
	 * agrega los errores encontrados
	 *
	 * @param key string
	 * @param error string
	 */
	public function setError($key, $error)
	{
		$this->errors[$key][] = $error;
	}

	/**
	 * devuelve si la validación es correcta
	 *
	 */
	public function isValid()
	{
		return $this->valid;
	}

	/**
	 * devuelve los errores de validación.
	 *
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * valida requerido.
	 *
	 * @param key string
	 * @param value string
	 *
	 */
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

	/**
	 * valida nombre.
	 *
	 * @param key string
	 * @param value string
	 *
	 */
	public function name($key, $value)
	{
		if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]*$/", $value)) {
			$this->valid = false;
			$this->setError($key, "El campo $key sólo puede contener letras y espacios");
			return false;
		}
		return true;
	}

	/**
	 * valida rut.
	 *
	 * @param key string
	 * @param value string
	 *
	 */
	public function rut($key, $value)
	{
		$value = preg_replace('/[^0-9Kk]/', '', $value);

		if (strlen($value) < 8) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un rut válido");
			return false;
		}

		$dv = strtoupper(substr($value, -1));
		$numero = substr($value, 0, -1);

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

		if($dv != $dv_calculado){
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un rut válido");
			return false;
		}
		return true;
	}


	/**
	 * valida email.
	 *
	 * @param key string
	 * @param value string
	 *
	 */
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


	/**
	 * valida arreglo.
	 *
	 * @param key string
	 * @param value string
	 *
	 */
	public function array($key, $value)
	{
		if (!is_array($value)) {
			$this->valid = false;
			$this->setError($key, "El campo $key debe ser un arreglo");
			return false;
		}
		return true;
	}

	/**
	 * valida largo mínimo.
	 *
	 * @param key string
	 * @param value string
	 * @param filter integer
	 *
	 */
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

	/**
	 * valida alfanumérico.
	 *
	 * @param key string
	 * @param value string
	 *
	 */
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
