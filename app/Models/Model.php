<?php

namespace App\Models;

use App\Database\MySQLDatabase;
class Model
{
	private $db,
		$table,
		$_where,
		$_whereOr,
		$_orderBy;

	public function __construct($table)
	{
		$db = new MySQLDatabase(env('DB_HOST'), env('DB_USER'), env('DB_PASSWD'), env('DB_NAME'));
		$db->connect();
		$this->table = $table;
		$this->db = $db;
		$this->_where = [];
		$this->_whereOr = [];
	}

	/**
	 * crea un registro en la base de datos.
	 *
	 * @param data array.
	 * @return si se crea correctamente el registro retorna el id del registro, si no retorna false
	 */
	public function create($data)
	{
		$data = $this->db->escape($data);

		$cols = $values = "";
		$first = true;
		foreach ($data as $col => $value) {
			if (!$first) {
				$cols .= ', ';
				$values .= ', ';
			} else {
				$first = false;
			}
			$cols .= $col;
			if (is_numeric($value)) {
				$values .= $value;
			} else {
				$values .= "'$value'";
			}
		}

		$sql = "INSERT INTO $this->table ($cols) VALUES ($values)";

		$result = $this->db->query($sql);

		if ($result) {
			return mysqli_insert_id($this->db->connection);
		} else {
			return false;
		}
	}

	/**
	 * busca un registro por el id
	 *
	 * @param id integer.
	 * @return resultado de la consulta
	 */
	public function find($id)
	{
		$id = intval($id);

		return $this->where('id', $id)->get();
	}

	/**
	 * busca registros
	 *
	 * @return resultado de la consulta
	 */
	public function get()
	{
		$sql = "SELECT * FROM $this->table";

		if (count($this->_where)) {
			$first = true;
			foreach ($this->_where as $where) {
				if ($first) {
					$sql .= ' WHERE ';
				} else {
					$sql .= ' AND ';
					$first = false;
				}

				$sql .= $where;
			}
		}

		if (count($this->_whereOr)) {
			$first = true;
			foreach ($this->_whereOr as $where) {
				if ($first) {
					$sql .= ' WHERE ';
				} else {
					$sql .= ' OR ';
					$first = false;
				}

				$sql .= $where;
			}
		}

		$sql .= $this->_orderBy;

		return $this->query($sql);
	}


	/**
	 * agrega clausula where (amd) a la consulta
	 *
	 * @param col string
	 * @param value string
	 * @param operator sting Posibles valores '='(default), '<', '>', '<=', '>=', '<>', '!=', 'LIKE', 'NOT LIKE',
	 * 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN
	 *
	 * @return instancia actual del objeto.
	 */
	public function where($col, $value, $operator = '=')
	{
		if (is_numeric($value)) {
			$this->_where[] .= "$col $operator $value";
		} else {
			$this->_where[] .= "$col $operator '$value'";
		}
		return $this;
	}

	/**
	 * agrega clausula where (or) a la consulta
	 *
	 * @param col string
	 * @param value string
	 * @param operator sting Posibles valores '='(default), '<', '>', '<=', '>=', '<>', '!=', 'LIKE', 'NOT LIKE',
	 * 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN
	 *
	 * @return instancia actual del objeto.
	 */
	public function whereOr($col, $value, $operator = '=')
	{
		if (is_numeric($value)) {
			$this->_whereOr[] .= "$col $operator $value";
		} else {
			$this->_whereOr[] .= "$col $operator '$value'";
		}
		return $this;
	}

	/**
	 * agrega la clausula order by clause a la consulta.
	 *
	 * @param orderBy string
	 * @param order string. default 'ASC'.
	 *
	 * @return instancia actual del objeto.
	 */
	public function orderBy($orderBy, $order = 'ASC')
	{
		if ($orderBy) {
			$this->_orderBy = " ORDER BY $orderBy $order";
		}
		return $this;
	}


	/**
	 * ejecuta la consulta
	 *
	 * @param sql string.
	 * @return resultado de la consulta
	 */
	public function query($sql)
	{
		$result = $this->db->query($sql);

		if ($result) {
			$response = array();
			while ($row = mysqli_fetch_assoc($result)) {
				$response[] = array_map('utf8_encode', $row);
			}
			if (count($response) == 1) {
				return $response[0];
			}
			return $response;
		} else {
			return false;
		}
	}
}
