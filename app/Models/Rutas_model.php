<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Rutas_model extends Model
{
    public function getRutas($where = array(), $select = '')
    {
        $rutas = $this->db->table('rutas');

        $select = trim($select);

        if (!empty($where)) {
            $rutas->where($where);
        } else {
            $rutas->where("eliminado", false);
        }
        $rutas->orderBy('id', 'desc');
        return $rutas->get()->getResultObject();
    }

    public function getRutaWhere($where, $select = '')
    { #select con where
        $ruta = $this->db->table('rutas');
        $select = trim($select);
        if (!empty($select)) {
            $ruta->select($select);
        }
        if (!empty($where)) {
            $ruta->where($where);
        }
        return $ruta->get()->getRowObject();
    }
    public function updateRuta($data, $id)
    {
        $ruta = $this->db->table('rutas');
        $ruta->set($data);
        $ruta->where("id", $id);
        return $ruta->update();
    }
    public function getRuta($id)
    {
        $ruta = $this->db->table('rutas');
        $ruta->where("id", $id);
        return $ruta->get()->getRowObject();
    }
    public function insertRuta($data)
    {
        $ruta = $this->db->table('rutas');
        $insert = $ruta->insert($data);
        if ($insert) {
            $lastInsertedID = $this->db->insertID();
            //pre_die($lastInsertedID);
            return $lastInsertedID;
        } else {
            return false;
        }
    }
    public function deleteRuta($data, $id)
    {
        $ruta = $this->db->table('rutas');
        $ruta->set($data);
        $ruta->where("id", $id);
        return $ruta->update();
    }

    public function GetClientesRutaComuna($comuna_id)
    {
        $where_clientes = [
            'c.estado' => true,
            'c.eliminado' => false,
            'c.comuna_id' => $comuna_id
        ];

        $clientes = $this->db->table('clientes c');
        $clientes->select('c.*, p.nombre as nombre_producto_favorito');
        $clientes->where($where_clientes);
        $clientes->join("productos p", 'c.producto_id = p.id', 'left');
        return $clientes->get()->getResultObject();
    }

}
