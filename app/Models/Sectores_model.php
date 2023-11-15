<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Sectores_model extends Model
{
    public function getSectores($where = array(), $select = '')
    {
        $sectores = $this->db->table('sectores');

        $select = trim($select);
        if (!empty($where)) {
            $sectores->where($where);
        } else {
            $sectores->where("eliminado", false);
        }
        return $sectores->get()->getResultObject();
    }
    public function getSectorWhere($where, $select = '')
    { #select con where
        $sector = $this->db->table('sectores');
        $select = trim($select);
        if (!empty($select)) {
            $sector->select($select);
        }
        if (!empty($where)) {
            $sector->where($where);
        }
        return $sector->get()->getRowObject();
    }
    public function updateSector($data, $id)
    {
        $sector = $this->db->table('sectores');
        $sector->set($data);
        $sector->where("id", $id);
        return $sector->update();
    }
    public function getSector($id)
    {
        $sector = $this->db->table('sectores');
        $sector->where("id", $id);
        return $sector->get()->getRowObject();
    }
    public function insertSector($data)
    {
        $sector = $this->db->table('sectores');
        $insert = $sector->insert($data);
        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }
    public function deleteSector($data, $id)
    {
        $sector = $this->db->table('sectores');
        $sector->set($data);
        $sector->where("id", $id);
        return $sector->update();
    }

    public function GetClientesSectorComuna($comuna_id)
    {
        $where_clientes = [
            'estado' => true,
            'eliminado' => false,
            'comuna_id' => $comuna_id
        ];

        $clientes = $this->db->table('clientes');
        $clientes->where($where_clientes);
        return $clientes->get()->getResultObject();
    }
}
