<?php
//defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class Ventas_model extends Model
{
    public function getVentas($where = array(), $select = '')
    {
        $ventas = $this->db->table('ventas');

        $select = trim($select);
        if (!empty($where)) {
            $ventas->where($where);
        } else {
            $ventas->where("eliminado", false);
        }
        return $ventas->get()->getResultObject();
    }
    public function getVentasRuta($ruta_id)
    {
        $ventas = $this->db->table('ventas');
        $where = [
            'estado' => true,
            'eliminado' => false,
            'ruta_id' => $ruta_id
        ];
        if (!empty($where)) {
            $ventas->where($where);
        } else {
            $ventas->where("eliminado", false);
        }
        return $ventas->get()->getResultObject();
    }
    public function getVentasJoin($where, $select = '')
    {
        $ventas = $this->db->table('ventas v');

        $select = trim($select);
        $ventas->join("productos_venta pv", 'pv.venta_id = v.id', 'left');
        if (empty($select)) {
            $ventas->select('v.*, pv.*');
        } else {
            $ventas->select($select);
        }
        if (!empty($where)) {
            $ventas->where($where);
        } else {
            $ventas->where("eliminado", false);
        }

        return $ventas->get()->getResultObject();
    }
    public function GetVentaWhere($where, $select = '')
    { #select con where
        $venta = $this->db->table('ventas');
        $select = trim($select);
        if (!empty($select)) {
            $venta->select($select);
        }
        if (!empty($where)) {
            $venta->where($where);
        }
        return $venta->get()->getRowObject();
    }
    public function updateVenta($data, $id)
    {
        $venta = $this->db->table('ventas');
        $venta->set($data);
        $venta->where("id", $id);
        return $venta->update();
    }
    public function getVenta($id)
    {
        $venta = $this->db->table('ventas');
        $venta->where("id", $id);
        return $venta->get()->getRowObject();
    }
    public function insertVenta($data)
    {
        $venta = $this->db->table('ventas');
        $insert = $venta->insert($data);
        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }
    public function deleteVenta($data, $id)
    {
        $venta = $this->db->table('ventas');
        $venta->set($data);
        $venta->where("id", $id);
        return $venta->update();
    }

    public function GetClientesVentaComuna($comuna_id)
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