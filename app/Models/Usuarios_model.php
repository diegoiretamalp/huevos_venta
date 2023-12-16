<?php
//defined('BASEPATH') or exit('No direct script access allowed');
//hola
use CodeIgniter\Model;

class Usuarios_model extends Model
{
	public function getUsuarios($where = array(), $select = '')
	{
		$usuarios = $this->db->table('usuarios');

		$select = trim($select);
		if (!empty($where)) {
			$usuarios->where($where);
		} else {
			$usuarios->where("eliminado", false);
		}
		return $usuarios->get()->getResultObject();
	}

	public function getUsuariosJoin($where = array(), $select = '')
	{
		$usuarios = $this->db->table('usuarios u');

		$select = trim($select);

		$usuarios->join("perfiles p", 'p.id = u.perfil_id', 'left');;
		if (empty($select)) {

			$usuarios->select('u.*, p.nombre as nombre_perfil, u.nombre as nombre_usuario');

		} else {
			$usuarios->select($select);
		}

		if (!empty($where)) {
			$usuarios->where($where);
		} else {
			$usuarios->where("u.eliminado", false);
		}

		return $usuarios->get()->getResultObject();
	}

	public function getUsuarioWhere($where, $select = '')
	{ #select con where
		$usuario = $this->db->table('usuarios');
		$select = trim($select);
		if (!empty($select)) {
			$usuario->select($select);
		}
		if (!empty($where)) {
			$usuario->where($where);
		}
		return $usuario->get()->getRowObject();
	}
	public function updateUsuario($data, $id)
	{
		$usuario = $this->db->table('usuarios');
		$usuario->set($data);
		$usuario->where("id", $id);
		return $usuario->update();
	}
	public function getUsuario($id)
	{
		$usuario = $this->db->table('usuarios');
		$usuario->where("id", $id);
		return $usuario->get()->getRowObject();
	}

	public function insertUsuario($data)
	{
		$usuario = $this->db->table('usuarios');
		$insert = $usuario->insert($data);
		if ($insert) {
			return $insert;
		} else {
			return false;
		}
	}
	public function deleteUsuario($data, $id)
	{
		$usuario = $this->db->table('usuarios');
		$usuario->set($data);
		$usuario->where("id", $id);
		return $usuario->update();
	}
}
