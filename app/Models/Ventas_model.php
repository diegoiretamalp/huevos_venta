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
        $ventas->join("productos p", 'p.id = pv.producto_id', 'left');
        $ventas->join("pagos_venta pave", 'pave.venta_id = v.id', 'left');
        $ventas->join("metodos_pago mp", 'mp.id = pave.metodo_pago_id', 'left');
        $ventas->join("clientes c", 'c.id = v.cliente_id', 'left');

        if (empty($select)) {
            $ventas->select('v.*, pv.*, p.nombre as nombre_producto, mp.nombre as metodo_pago, CONCAT(c.nombre, " ", c.apellido_paterno, " ", c.apellido_materno) as nombre_cliente');
        } else {
            $ventas->select($select);
        }

        if (!empty($where)) {
            $ventas->where($where);
        } else {
            $ventas->where("v.eliminado", false);
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

    public function GetPagosVentaCliente($where = [])
    {
        $pagos = $this->db->table('pagos_venta pv');

        $pagos->join("ventas v", 'v.id = pv.venta_id', 'left');
        $pagos->join("metodos_pago mp", 'mp.id = pv.metodo_pago_id', 'left');

        if (empty($select)) {
            $pagos->select('v.*, mp.nombre as nombre_metodo_pago, pv.monto_pago_actual as monto_pago_actual');
        } else {
            $pagos->select($select);
        }

        if (!empty($where)) {
            $pagos->where($where);
        } else {
            $pagos->where("v.eliminado", false);
        }

        return $pagos->get()->getResultObject();
    }
    public function GetVentasDetalle($where = [])
    {
        $ventasDetalle = $this->db->table('ventas v');

        $ventasDetalle->select('v.*, ' .
            'COUNT(DISTINCT pv.id) AS "N_Pagos", ' .
            'GROUP_CONCAT(CONCAT(p.nombre, " ($", FORMAT(prve.precio, 0), " - ", ' .
            'CASE prve.tipo_huevo WHEN \'b\' THEN \'BLANCO\' WHEN \'c\' THEN \'COLOR\' ELSE \'DESCONOCIDO\' END, ' .
            '")") SEPARATOR \', \') AS productos, ' .
            'v.total_venta AS "total_venta", ' .
            'SUM(DISTINCT pv.monto_pago_actual) AS "total_pagado"');

        $ventasDetalle->join('vi_pagos_venta pv', 'pv.venta_id = v.id', 'left');
        $ventasDetalle->join('vi_productos_venta prve', 'prve.venta_id = v.id', 'left');
        $ventasDetalle->join('vi_productos p', 'p.id = prve.producto_id', 'left');

        if (!empty($where)) {
            $ventasDetalle->where($where);
        } else {
            $ventasDetalle->where('v.eliminado', false);
        }

        return $ventasDetalle->groupBy('v.id, v.ruta_id, v.total_venta, v.total_pagado')->get()->getResultObject();
    }

    public function GetTotalDeudaCliente($cliente_id)
    {
        $total_deuda = $this->db->table('ventas v');
        $total_deuda->select('sum(v.total_venta - v.total_pagado) as total_deuda');
        // $total_deuda->join('productos p', 'p.id = v.producto_id', 'left');
        $total_deuda->where(['v.cliente_id' => $cliente_id, 'v.estado' => true, 'v.pagado' => false, 'v.eliminado' => false]);
        return $total_deuda->get()->getRowObject()->total_deuda;
    }
    public function GetTotalVentaCliente($cliente_id)
    {
        $total_deuda = $this->db->table('ventas v');
        $total_deuda->select('sum(v.total_venta) as total_venta, sum(v.cajas_total) as cajas_total');
        // $total_deuda->join('productos p', 'p.id = v.producto_id', 'left');
        $total_deuda->where(['v.cliente_id' => $cliente_id, 'v.estado' => true, 'v.eliminado' => false]);
        return $total_deuda->get()->getRowObject();

    }
    public function getVentasCliente($where, $select = '')
    {
        $ventas = $this->db->table('ventas v');

        $select = trim($select);

        // $ventas->join("clientes c", 'c.id = v.cliente_id', 'left');

        if (empty($select)) {
            $ventas->select('sum(v.total_venta) as total_compra, sum(v.total_pagado) as total_pagado, (sum(v.total_venta)-sum(v.total_pagado)) as total_deuda, count(*) as total_compras');
        } else {
            $ventas->select($select);
        }

        if (!empty($where)) {
            $ventas->where($where);
        } else {
            $ventas->where("v.eliminado", false);
        }

        return $ventas->get()->getRowObject();
    }

    public function getProductosVentaJoin($venta_id)
    {
        $ventas = $this->db->table('productos_venta pv');


        $ventas->join("productos p", 'p.id = pv.producto_id', 'left');

        if (empty($select)) {
            $ventas->select('pv.*, p.nombre as nombre_producto');
        } else {
            $ventas->select($select);
        }

        if (!empty($venta_id)) {
            $ventas->where(['pv.venta_id' => $venta_id]);
        } else {
            $ventas->where("pv.eliminado", false);
        }

        return $ventas->get()->getResultObject();
    }
    public function getPagosVentaJoin($venta_id)
    {
        $ventas = $this->db->table('pagos_venta pv');


        $ventas->join("metodos_pago mp", 'mp.id = pv.metodo_pago_id', 'left');

        if (empty($select)) {
            $ventas->select('pv.*, mp.nombre as metodo_pago');
        } else {
            $ventas->select($select);
        }

        if (!empty($venta_id)) {
            $ventas->where(['pv.venta_id' => $venta_id]);
        }

        return $ventas->get()->getResultObject();
    }
}


//hola