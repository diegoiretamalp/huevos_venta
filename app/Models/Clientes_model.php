<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Clientes_model extends Model
{
	public function getClientes($where = array(), $select = '')
	{
		$clientes = $this->db->table('clientes cli');

		if (!empty($select)) {
			$clientes->select($select);
		} else {
			$clientes->select('cli.*, p.nombre as "nombre_producto", s.nombre as "nombre_sector", m.total_deuda as "total_deuda" ');

		}
		if (!empty($where)) {
			$clientes->where($where);
		} else {
			$clientes->where("cli.eliminado", false);

		}
		$clientes->join("productos p", 'cli.producto_id = p.id', 'left');
		$clientes->join("sectores s", 'cli.sector_id = s.id', 'left');
		$clientes->join("monedero m", 'm.cliente_id = cli.id', 'left');

		return $clientes->get()->getResultObject();
	}

	public function getProductoWhere($where = array(), $select = '')
	{
		$clientes = $this->db->table('cliente cli');

		$select = trim($select);
		if (!empty($select)) {
			$clientes->select($select);
		} else {
			$clientes->select('cli.*, p.nombre "producto"');
		}
		if (!empty($where)) {
			$clientes->where($where);
		} else {
			$clientes->where("cli.eliminado", false);
		}
		$clientes->join("producto p", 'cli.producto_id = p.id', 'left');

		return $clientes->get()->getRowObject();
	}

	public function getClienteWhere($where, $select = '')
	{ #select con where
		$cliente = $this->db->table('clientes');
		$select = trim($select);
		if (!empty($select)) {
			$cliente->select($select);
		}
		if (!empty($where)) {
			$cliente->where($where);
		}
		return $cliente->get()->getRowObject();
	}
	public function updateCliente($data, $id)
	{
		$cliente = $this->db->table('clientes');
		$cliente->set($data);
		$cliente->where("id", $id);
		return $cliente->update();
	}
	public function getCliente($id)
	{
		$cliente = $this->db->table('clientes');
		$cliente->where("id", $id);
		return $cliente->get()->getRowObject();
	}

	public function insertCliente($data)
	{
		$cliente = $this->db->table('clientes');
		$insert = $cliente->insert($data);
		if ($insert) {
			return $insert;
		} else {
			return false;
		}
	}
	public function deleteCliente($data, $id)
	{
		$cliente = $this->db->table('clientes');
		$cliente->set($data);
		$cliente->where("id", $id);
		return $cliente->update();
	}
}
