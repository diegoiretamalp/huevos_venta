<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Empresas_model extends Model
{
    public function getEmpresas($where = array(), $select = '')
    {
        $empresas = $this->db->table('empresas');

        $select = trim($select);
        if (!empty($where)) {
            $empresas->where($where);
        } else {
            $empresas->where("eliminado", false);
        }
        return $empresas->get()->getResultObject();
    }
    public function getEmpresaWhere($where, $select = '')
    { #select con where
        $empresa = $this->db->table('empresas');
        $select = trim($select);
        if (!empty($select)) {
            $empresa->select($select);
        }
        if (!empty($where)) {
            $empresa->where($where);
        }
        return $empresa->get()->getRowObject();
    }
    public function updateEmpresa($data, $id)
    {
        $empresa = $this->db->table('empresas');
        $empresa->set($data);
        $empresa->where("id", $id);
        return $empresa->update();
    }
    public function getEmpresa($id)
    {
        $empresa = $this->db->table('empresas');
        $empresa->where("id", $id);
        return $empresa->get()->getRowObject();
    }
    public function insertEmpresa($data)
    {
        $empresa = $this->db->table('empresas');
        $insert = $empresa->insert($data);
        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }
    public function deleteEmpresa($data, $id)
    {
        $empresa = $this->db->table('empresas');
        $empresa->set($data);
        $empresa->where("id", $id);
        return $empresa->update();
    }

    public function GetClientesEmpresaComuna($comuna_id)
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
