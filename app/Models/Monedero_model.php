<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Monedero_model extends Model
{
	public function getMonederos($where = array(), $select = '')
	{
		$monedero = $this->db->table('monedero');

		$select = trim($select);
		if (!empty($where)) {
			$monedero->where($where);
		} else {
			$monedero->where("eliminado", false);
		}
		return $monedero->get()->getResultObject();
	}

	public function getMonederoWhere($where, $select = '')
	{ #select con where
		$monedero = $this->db->table('monedero');
		$select = trim($select);
		if (!empty($select)) {
			$monedero->select($select);
		}
		if (!empty($where)) {
			$monedero->where($where);
		}
		return $monedero->get()->getRowObject();
	}
	public function updateMonedero($data, $id)
	{
		$monedero = $this->db->table('monedero');
		$monedero->set($data);
		$monedero->where("id", $id);
		return $monedero->update();
	}
	public function getMonedero($id)
	{
		$monedero = $this->db->table('monedero');
		$monedero->where("id", $id);
		return $monedero->get()->getRowObject();
	}

    public function insertMonedero($data)
	{
		$monedero = $this->db->table('monedero');
		$insert = $monedero->insert($data);
		if ($insert) {
			return $insert;
		} else {
			return false;
		}
	}
	public function deleteMonedero($data, $id)
	{
		$monedero = $this->db->table('monedero');
		$monedero->set($data);
		$monedero->where("id", $id);
		return $monedero->update();
	}

}
