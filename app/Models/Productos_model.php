<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Productos_model extends Model
{
	public function getProductos($where = array(), $select = '')
	{
		$productos = $this->db->table('productos');

		$select = trim($select);
		if (!empty($where)) {
			$productos->where($where);
		} else {
			$productos->where("eliminado", false);
		}
		return $productos->get()->getResultObject();
	}

	public function getProductoWhere($where, $select = '')
	{ #select con where
		$producto = $this->db->table('productos');
		$select = trim($select);
		if (!empty($select)) {
			$producto->select($select);
		}
		if (!empty($where)) {
			$producto->where($where);
		}
		return $producto->get()->getRowObject();
	}
	public function updateProducto($data, $id)
	{
		$producto = $this->db->table('productos');
		$producto->set($data);
		$producto->where("id", $id);
		return $producto->update();
	}
	public function getProducto($id)
	{
		$producto = $this->db->table('productos');
		$producto->where("id", $id);
		return $producto->get()->getRowObject();
	}

    public function insertProducto($data)
	{
		$producto = $this->db->table('productos');
		$insert = $producto->insert($data);
		if ($insert) {
			return $insert;
		} else {
			return false;
		}
	}
	public function deleteProducto($data, $id)
	{
		$producto = $this->db->table('productos');
		$producto->set($data);
		$producto->where("id", $id);
		return $producto->update();
	}

}
