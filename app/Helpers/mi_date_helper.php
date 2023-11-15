<?php //if (!defined('BASEPATH')) exit('No direct script access allowed');

function ordenar_fechaHoraServidor($date)
{
    $date = new DateTime($date);
    $fechaFormat = $date->format('Y-m-d H:i:s');
    return $fechaFormat;
}

function ordenar_fechaServidor($date)
{
    $date = new DateTime($date);
    $fechaFormat = $date->format('Y-m-d');
    return $fechaFormat;
}

function fechaHumano_a_fechaServidor($date)
{
    $date = date("Y-m-d", strtotime($date));
    return $date;
}
function format_datepicket($date)
{
    $date = date("d-m-Y", strtotime($date));
    return $date;
}
function ordenar_fechaHumano($date)
{
    $explode = explode(" ", $date);
    $fecha = implode('-', array_reverse(explode('-', $explode[0])));
    return $fecha;
}

function ordenarFechaHumanoSlash($date)
{
    $explode = explode(" ", $date);
    $fecha = implode('/', array_reverse(explode('-', $explode[0])));
    return $fecha;
}

function ordenar_fechaHoraHumano($date)
{
    $explode = explode(" ", $date);
    $fecha[] = implode('-', array_reverse(explode('-', $explode[0])));
    $tiempo  = explode(":", $explode[1]);
    $fecha[] = $tiempo[0] . ':' . $tiempo[1];
    return implode(' ', $fecha);
}

function ordenar_fechaHoraMinutoHumano($date)
{
    $explode = explode(" ", $date);
    $fecha[] = implode('-', array_reverse(explode('-', $explode[0])));
    $fecha[] = $explode[1];
    return implode(' ', $fecha);
}
function ahoraServidor()
{
    return date('Y-m-d H:i:s');
}

function ahoraHumano()
{
    return date('d-m-Y H:i:s');
}

function obtenerRut($data)
{
    return substr((array_pop(explode('(', $data))), 0, -1);
}

function ahoraHumanoMesAno()
{
    $mes   = date('n');
    $meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    return $meses[$mes] . ' de ' . date('Y');
}

function agregar_diasFecha($fecha, $dias, $separador = '/')
{
    $explode = explode(" ", $fecha);
    $fecha = implode('-', array_reverse(explode('-', $explode[0])));
    $fecha = str_replace('-', '/', $fecha);

    list($day, $mon, $year) = explode('/', $fecha);
    return date('d' . $separador . 'm' . $separador . 'Y', mktime(0, 0, 0, $mon, $day + $dias, $year));
}

function agregar_diasFechaServidor($fecha, $dias, $separador = '/')
{
    $explode = explode(" ", $fecha);
    $fecha = implode('-', array_reverse(explode('-', $explode[0])));
    $fecha = str_replace('-', '/', $fecha);

    list($day, $mon, $year) = explode('/', $fecha);
    return date('Y' . $separador . 'm' . $separador . 'd', mktime(0, 0, 0, $mon, $day + $dias, $year));
}

function diaSemana($dia, $mes, $ano)
{
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
}

function traerNumeroDia($dia)
{
    $return = '';
    $dias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');
    foreach ($dias as $key => $value) {
        if ($value == $dia) {
            $return = $key;
        }
    }
    return $return;
}

function traerTextoDia($dia)
{
    $return = '';
    $dias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');
    foreach ($dias as $key => $value) {
        if ($key == $dia) {
            $return = $value;
        }
    }
    return $return;
}


function traerNumeroMes($mes)
{
    $return = '';

    $meses = array(
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
        7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    );
    foreach ($meses as $key => $value) {
        if (strUpper($value) == strUpper($mes)) {
            $return = $key;
        }
    }
    return $return;
}



function traerTextoMes($mes)
{
    $return = '';
    $meses = array(
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
        7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    );
    foreach ($meses as $key => $value) {
        if ($key == $mes) {
            $return = $value;
        }
    }
    return $return;
}
function traerTextoMesCorto($mes)
{
    $return = '';
    $meses = array(
        1 => "Ene", 2 => "Feb", 3 => "Mar", 4 => "Abr", 5 => "May", 6 => "Jun",
        7 => "Jul", 8 => "Ago", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dic"
    );
    foreach ($meses as $key => $value) {
        if ($key == $mes) {
            $return = $value;
        }
    }
    return $return;
}
function rangoFechas($fecha_inicio, $fecha_termino, $dia, $mes)
{
    list($ano_inicio, $mes_inicio, $dia_inicio)       = explode('-', $fecha_inicio);
    list($ano_termino, $mes_termino, $dia_termino)    = explode('-', $fecha_termino);

    $dias_inicio  = cal_days_in_month(CAL_GREGORIAN, $mes_inicio, $ano_inicio);
    $dias_termino = cal_days_in_month(CAL_GREGORIAN, $mes_termino, $ano_termino);
    if ($mes_inicio == $mes_termino) {
        $dia;
    } else {
    }
}

function traerMeses()
{
    $return = '';
    return array(
        0 => "Todo", 1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
        7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    );
}
function traerSoloMeses()
{
    $return = '';
    return array(
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
        7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    );
}


function validateFechaFin($duracion = null)
{
    if (!isset($duracion) || empty($duracion) || $duracion == 0) {
        $duracion  = 0;
    }
    #FUNCIÓN PARA EVITAR FINES DE SEMANA Y FESTIVOS
    $fechaHoy = date('Y-m-d'); #SE OBTIENE FECHA ACTUAL
    if ($duracion >= 1) {
        $sumaDias = 0; #VARIABLE PARA ALMACENAR TOTAL DÍA FIN DE SEMANA
        $i = 1;
        while ($i <= ($duracion)) : #SE RECORREN DÍAS PARA EXTRAER FINES DE SEMANAS 
            $fechaFin =  strtotime('+' . $i . ' day', strtotime($fechaHoy)); #SE SUMAN DÍAS DE DURACIÓN A FECHA ACTUAL
            $diaVariante = date('N', $fechaFin); #SE OBTIENE NÚMERO DEL DÍA  
            if ($diaVariante == 6 || $diaVariante == 7) { #SE VALIDA QUE SEA SABADO O DOMINGO
                $sumaDias++; #SE AÑADE 1 DÍA POR CADA VEZ QUE ENCUENTRE
            }
            $i++;
        endwhile;

        $fechaFin = date('Y-m-d', $fechaFin); #SE OBTIENE FECHA DE FIN SIN FINES DE SEMANA  
        $fechaFin =  strtotime('+' . $sumaDias . ' day', strtotime($fechaFin)); #SE LE SUMAN DÍAS OBTENIDOS POR FINES DE SEMANA
        $fechaFin = date('Y-m-d', $fechaFin); #SE OBTIENE FECHA DE FIN SIN FINES DE SEMANA  

    } else {
        $fechaFin = $fechaHoy;
    }
    $dias = array(1 => 'LUNES', 2 => 'MARTES', 3 => 'MIERCOLES', 4 => 'JUEVES', 5 => 'VIERNES', 6 => 'SABADO', 7 => 'DOMINGO');
    $fechaFinal = validaFeriado($fechaFin); #SE VALIDA QUE FECHA FIN NO SEA FERIADO
    $diaFin = date('N', strtotime($fechaFinal)); #SE OBTIENE NÚMERO DEL DÍA 
    #SE OBTIENE EL NOMBRE DEL DÍA
    foreach ($dias as $key => $value) {
        if ($key == $diaFin) {
            $diaFinNombre = $value;
        }
    }

    #SE VALIDA SI FECHA ES FIN DE SEMANA 
    if ($diaFinNombre == "SABADO") {
        $fechaFinNueva =  strtotime('+2 day', strtotime($fechaFinal)); #SI ES SABADO SE LE SUMAN 2 DÍAS
        $fechaFinNueva = date('Y-m-d', $fechaFinNueva);
    } elseif ($diaFinNombre == "DOMINGO") {
        $fechaFinNueva =  strtotime('+1 day', strtotime($fechaFinal));  #SI ES DOMINGO SE LE SUMA 1 DÍA
        $fechaFinNueva = date('Y-m-d', $fechaFinNueva);
    } else {
        $fechaFinNueva = $fechaFinal; #SI ES DIA DE SEMANA SE DEJA LA FECHA FIN YA OBTENIDA            
    }

    return $fechaFinNueva;
}

function validaFeriado($fecha)
{
    $fechaFeriado = get_row_by_where('feriados', ['fecha' => $fecha]);
    if (empty($fechaFeriado)) { #SI FECHA NO ES FERIADO DEVUELVE FECHA
        return $fecha;
    } else {
        $fechaNueva =  strtotime('+1 day', strtotime($fechaFeriado->fecha)); #SI FERIADO SE LE SUMA 1 DÍA 
        $fechaNueva = date('Y-m-d', $fechaNueva);
        return validaFeriado($fechaNueva); #SE RETORNA A FUNCION DE VALIDACIÓN
    }
}


function meses_valida_day($dia_pago, $fecha_actual_pago)
{
    $meses_31 = ['01', '03', '05', '07', '08', '10', '12'];
    $fecha_pago = $fecha_actual_pago;
    $obtiene_mes = date("m", strtotime($fecha_pago));
    if ($obtiene_mes == '02' && $dia_pago >= 28) {
        $fecha_pago = date("Y-m-t", strtotime($fecha_pago));
    } elseif (in_array($obtiene_mes, $meses_31)) {
        $fecha_pago = date("Y-m-$dia_pago", strtotime($fecha_actual_pago));
    }

    return $fecha_pago;
}

function fecha_mes_texto($fecha = '')
{
    if (empty($fecha)) {
        $fecha = date('Y-m-d');
    }

    $dia = date("d", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $mes = traerTextoMesCorto($mes);
    $annio = date("Y", strtotime($fecha));
    $fecha_formateada = $dia . '-' . strUpper($mes) . '-' . $annio;
    return trim($fecha_formateada);
}


function getTimestamp()
{
    return date('Y-m-d H:i:s');
}
function getTimestampMenos1Mes()
{
    $timestamp = strtotime('-1 month');
    return date('Y-m-d H:i:s', $timestamp);
}
function getTimestampMenos2Meses()
{
    $timestamp = strtotime('-2 month');
    return date('Y-m-d H:i:s', $timestamp);
}

function getTimestampMas1Dia()
{
    $timestamp = time();
    $timestamp += 86400;
    return date('Y-m-d H:i:s', $timestamp);
}
function getDateToday()
{
    return date('Y-m-d');
}
function getDateTodayMenos1Mes()
{
    $currentDate = date('Y-m-d');  // Get the current date in the format 'YYYY-MM-DD'
    $oneMonthAgo = date('Y-m-d', strtotime('-1 month', strtotime($currentDate)));  // Subtract one month from the current date

    return $oneMonthAgo;  // Output the resulting date
}
