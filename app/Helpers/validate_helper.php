<?php
//if (!defined('BASEPATH')) exit('No direct script access allowed');

//use Usuarios_model as GlobalUsuarios_model;
require_once 'vendor/autoload.php';

use CodeIgniter\Database\Exceptions\DatabaseException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

//use PhpOffice\PhpSpreadsheet\Spreadsheet;

function formatearFechaFiltro($fecha) {
    // Crea un objeto DateTime a partir de la fecha proporcionada
    $fechaObj = new DateTime($fecha);

    // Formatea la fecha en el formato deseado
    $fechaFormateada = $fechaObj->format('Y-m-d H:i:s.u');

    return $fechaFormateada;
}


function consulta($query, $conn)
{
	ini_set('memory_limit', '-1');
	try {
		$stmt = $conn->prepare($query);
		$stmt->execute();
		return  $stmt->fetchAll(PDO::FETCH_OBJ);
	} catch (PDOException $exp) {
		echo 'Error en la consulta SQL ejecutada: ' . $exp->getMessage();
		return false;
	}
}

function sumaGeneralRow($data, $where)
{
	$sumaGeneral = 0;
	foreach ($data as $key => $value) {
		foreach ($value as $k => $v) {
			if (strLower($k) === strLower($where)) {
				$sumaGeneral += (int)$v;
			}
		}
	}
	return $sumaGeneral;
}

function validaFiltros($query)
{
	$query = strLower($query);
	$filtros = [];

	if (strpos($query, 'anoinput') !== false) {
		$filtros['filtroAno'] = true;
	}
	if (strpos($query, 'mesinput') !== false) {
		$filtros['filtroMes'] = true;
	}
	if (strpos($query, 'rutinput') !== false) {
		$filtros['filtroRut'] = true;
	}
	if (strpos($query, 'estadoinput') !== false) {
		$filtros['filtroEstado'] = true;
	}
	if (strpos($query, 'desdeinput') !== false) {
		$filtros['filtroFechaDesde'] = true;
	}
	if (strpos($query, 'hastainput') !== false) {
		$filtros['filtroFechaHasta'] = true;
	}
	if (strpos($query, 'fechainicial') !== false) {
		$filtros['filtroFechaInicial'] = true;
	}
	if (strpos($query, 'fechafinal') !== false) {
		$filtros['filtroFechaFinal'] = true;
	}
	if (strpos($query, 'vendedorinput') !== false) {
		$filtros['filtroVendedor'] = true;
	}
	if (strpos($query, 'itemcodeinput') !== false) {
		$filtros['filtroItemCode'] = true;
	}
	if (strpos($query, 'docentryinput') !== false) {
		$filtros['filtroDocEntry'] = true;
	}
	if (strpos($query, 'descripcioninput') !== false) {
		$filtros['filtroDescripcion'] = true;
	}
	if (strpos($query, 'centroinput') !== false) {
		$filtros['filtroCentro'] = true;
	}
	if (strpos($query, 'grupoinput') !== false) {
		$filtros['filtroGrupo'] = true;
	}

	return $filtros;
}




function convertirDatos($datos)
{
	$labelsG = [];
	$dataG = [];
	$string = null;
	$kString = null;
	$cero = null;
	$uno = null;
	$kCero = null;
	$kUno = null;
	$isObject = false;
	$count = [];
	if (!empty($datos) && count($datos) > 10) {
		$datos = array_slice($datos, 0, 10);
	}
	foreach ($datos as $d_key => $d_value) {

		$keys = array_keys($d_value);
		$values = array_values($d_value);
		if (count($keys) == 2) {
			$cero = $values[0];
			$kCero = $keys[0];
			$uno = $values[1];
			$kUno = $keys[1];
			break;
		} else if (count($keys) == 3) {
			$valuesAntiguo = array_merge([], $values);
			$values = ordenarArray($values);
			foreach ($values as $key3 => $value3) {
				$cloneValues = array_merge([], $values);

				if (is_string($value3)) {
					//pre_die($keys);
					$string = $value3;
					// pre_die($valuesAntiguo);
					if (is_string($valuesAntiguo[0])) {
						$kString = 0;
						$cero = $valuesAntiguo[1];
						$uno = $valuesAntiguo[2];
						$kCero = 1;
						$kUno = 2;
					} else if (is_string($valuesAntiguo[1])) {
						//pre_die($);
						$cero = $valuesAntiguo[0];
						$kString = 1;
						$uno = $valuesAntiguo[2];
						$kCero = 0;
						$kUno = 2;
					} else if (is_string($valuesAntiguo[2])) {
						$cero = $valuesAntiguo[0];
						$uno = $valuesAntiguo[1];
						$kString = 2;
						$kCero = 0;
						$kUno = 1;
					}
					/*unset($cloneValues[$key3]);
					$cloneValues = array_values($cloneValues);
					$cloneValues = ordenarArray($cloneValues);*/
					//pre_die($cloneValues);
					break;
				}
			}
		}
	}

	foreach ($datos as $key1 => $value1) {
		foreach ($value1 as $key2 => $value2) {
			if (is_object($cero)) {
				//pre_die($value1);
				$isObject = true;
				array_push($labelsG, utf8_encode($value1[$kUno]));
				array_push($dataG, $value1[$kCero]->format('Y-m-d'));
				break;
			} else if (is_object($uno)) {

				$isObject = true;
				array_push($labelsG, is_numeric($value1[$kCero]) ? (int)$value1[$kCero] : $value1[$kCero]);
				array_push($dataG, $value1[$kUno]->format('Y-m-d'));
				break;
			} else if (is_numeric($cero) && is_numeric($uno)) {

				if ((int)$cero > (int)$uno) {
					if (is_string($string)) {
						$valuesGen = array_values($value1);
						$aaa = ordenarArray($valuesGen);

						array_push($labelsG, $valuesGen[$kUno] . '(' . utf8_encode($valuesGen[$kString]) . ')');
						array_push($dataG, $valuesGen[$kCero]);

						break;
					} else {

						array_push($labelsG, $value1[$kUno]);
						array_push($dataG, $value1[$kCero]);
						break;
					}
				} else {
					if (is_string($string)) {
						$valuesGen = array_values($value1);
						$aaa = ordenarArray($valuesGen);

						array_push($labelsG, $valuesGen[$kCero] . '(' . utf8_encode($valuesGen[$kString]) . ')');
						array_push($dataG, $valuesGen[$kUno]);

						break;
					} else {
						array_push($labelsG, strUpper(utf8_encode($value1[$kCero])));
						array_push($dataG, $value1[$kUno]);
						break;
					}


					break;
				}
			} else if (is_numeric($cero)) {
				array_push($labelsG, strUpper(utf8_encode($value1[$kUno])));
				array_push($dataG, $value1[$kCero]);
				break;
			} else if (is_numeric($uno)) {

				array_push($labelsG, strUpper(utf8_encode($value1[$kCero])));
				array_push($dataG, $value1[$kUno]);
				break;
			}
		}
	}
	$return = [
		'labels' => $labelsG,
		'data' => $dataG,
		'isObject' => $isObject
	];
	//pre_die($return);

	return $return;
}


function ordenarArray($array)
{
	usort($array, function ($a, $b) {
		if (is_string($a) && !is_string($b)) {
			return -1; // $a es un string y $b no es un string, $a se coloca antes
		} elseif (!is_string($a) && is_string($b)) {
			return 1; // $a no es un string y $b es un string, $a se coloca después
		} else {
			return 0; // Ambos son del mismo tipo, no se modifica el orden
		}
	});
	return $array;
}
function validaReemplazos($query, $post = null, $omite = false)
{

    $query = strLower($query);
    if (strpos($query, 'centroinput')) {
        if (empty($post['centroInput'])) {
            $query = str_replace("'centroinput'", 'NULL', $query);
        } else {
            $query = str_replace('centroinput', trim($post['centroInput']), $query);
        }
    }
    if (strpos($query, 'grupoinput')) {
        if (empty($post['grupoInput'])) {
            $query = str_replace("'grupoinput'", 'NULL', $query);
        } else {
            $query = str_replace('grupoinput', trim($post['grupoInput']), $query);
        }
    }
    if (strpos($query, 'anoinput')) {
        $query = str_replace('anoinput', (!empty($post['anoInput']) ? $post['anoInput']  : 0), $query);
    }
    if (strpos($query, 'mesinput')) {
        $query = str_replace('mesinput', (!empty($post['mesInput']) ? $post['mesInput'] : 0), $query);
    }
    if (strpos($query, 'vendedorinput')) {
        $query = str_replace('vendedorinput', (!empty($post['vendedorInput']) ? trim($post['vendedorInput']) : ''), $query);
    }
    if (strpos($query, 'clienteinput')) {
        $query = str_replace('clienteinput', (!empty($post['vendedorInput']) ? trim($post['vendedorInput']) : ''), $query);
    }

    if (strpos($query, 'nro_documento')) {
        $query = str_replace('nro_documento', (!empty($post['nro_documento']) ? soloNumeros($post['nro_documento']) : ''), $query);
    }
    if ($omite) {
        $query = str_replace("'desdeinput'", 'NULL', $query);
        $query = str_replace("'hastainput'", 'NULL', $query);
    } else {
        if (strpos($query, 'desdeinput')) {
            if (isset($post['desdeInput'])) {
                $query = str_replace('desdeinput', !empty($post['desdeInput']) ? ordenar_fechaHoraServidor($post['desdeInput']) : ordenar_fechaHoraServidor(getTimestampMenos1Mes()), $query);
            } elseif (isset($post['fecha_inicial'])) {
                $query = str_replace('desdeinput', !empty($post['fecha_inicial']) ? ordenar_fechaHoraServidor($post['fecha_inicial']) : ordenar_fechaHoraServidor(getTimestampMenos1Mes()), $query);
            } else {
                $query = str_replace('desdeinput', ordenar_fechaHoraServidor(getTimestampMenos1Mes()), $query);
            }
        }
        if (strpos($query, 'hastainput')) {
            if (isset($post['hastainput'])) {
                $query = str_replace('hastainput', !empty($post['hastainput']) ? ordenar_fechaHoraServidor($post['hastainput']) : ordenar_fechaHoraServidor(getTimestamp()), $query);
            } elseif (isset($post['fecha_final'])) {
                $query = str_replace('hastainput', !empty($post['fecha_final']) ? ordenar_fechaHoraServidor($post['fecha_final']) : ordenar_fechaHoraServidor(getTimestamp()), $query);
            } else {
                $query = str_replace('hastainput', ordenar_fechaHoraServidor(getTimestamp()), $query);
            }
        }
        if (strpos($query, 'fechafinal')) {

            $query = str_replace('fechafinal', !empty($post['fecha_final']) ? ordenar_fechaHoraServidor($post['fecha_final']) : ordenar_fechaHoraServidor(getTimestamp()), $query);
        }
        if (strpos($query, 'fechainicial')) {
            $query = str_replace('fechainicial', !empty($post['fecha_inicial']) ? ordenar_fechaHoraServidor($post['fecha_inicial']) : ordenar_fechaHoraServidor(getTimestampMenos1Mes()), $query);
        }
    }
    if (empty($post['estadoInput']) || $post['estadoInput'] == '0') {
        $query = str_replace("'estadoinput'",  'NULL', $query);
    } else {
        $query = str_replace('estadoinput', $post['estadoInput'], $query);
    }
    if (empty($post['rutInput'])) {
        $query = str_replace("'rutinput'", 'NULL', $query);
    } else {
        $query = str_replace('rutinput', trim($post['rutInput']), $query);
    }

    if (empty($post['itemCodeInput'])) {
        $query = str_replace("'itemcodeinput'", 'NULL', $query);
    } else {
        $query = str_replace('itemcodeinput', trim($post['itemCodeInput']), $query);
    }
    if (empty($post['docEntryInput'])) {
        $query = str_replace("'docentryinput'", 'NULL', $query);
    } else {
        $query = str_replace('docentryinput', soloNumeros($post['docEntryInput']), $query);
    }
    if (empty($post['docNumInput'])) {
        $query = str_replace("'docnuminput'", 'NULL', $query);
    } else {
        $query = str_replace('docnuminput', soloNumeros($post['docNumInput']), $query);
    }
    if (empty($post['cardCodeInput'])) {
        $query = str_replace("'cardcodeinput'", 'NULL', $query);
    } else {
        $query = str_replace('cardcodeinput', trim($post['cardCodeInput']), $query);
    }

    if (empty($post['descripcionInput'])) {
        $query = str_replace("'descripcioninput'", 'NULL', $query);
    } else {
        $query = str_replace('descripcioninput', trim($post['descripcionInput']), $query);
    }

    return $query;
}

function getEmpresa($id)
{
	$db      = \Config\Database::connect();
	$empresas = $db->table('empresas');
	$nombre = $empresas->getWhere(['id' => $id])->getRowObject();
	return isset($nombre->razon_social) ? $nombre->razon_social : 'Sin informaciónnn';
}

function validar_query($query)
{
	$valida = false;
	if(empty($query)){
		$valida = true;
	}
	if (strpos($query, 'update') !== false) {
		$valida = true;
	}
	if (strpos($query, 'delete') !== false) {
		$valida = true;
	}
	if (strpos($query, 'insert') !== false) {
		$valida = true;
	}
	/*if (strpos($query, 'union') !== false) {
            $valida = true;
        }*/
	if (strpos($query, 'UPDATE') !== false) {
		$valida = true;
	}
	if (strpos($query, 'DELETE') !== false) {
		$valida = true;
	}
	if (strpos($query, 'INSERT') !== false) {
		$valida = true;
	}
	return $valida;
}

function generarMensaje($token)
{
	$mensaje = '
	<!DOCTYPE html>
<html>
<head>
	<title>Tu archivo está listo para descargar</title>
	<!-- Carga los estilos de Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- Estilos personalizados -->
	<style>
		body {
			background-color: #F0F0F0;
			color: #444;
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			margin: 0;
			padding: 0;
		}
		.container {
			background-color: #FFF;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
			margin: 50px auto;
			max-width: 600px;
			padding: 20px;
			text-align: center;
		}
		h1 {
			color: #0467DB;
			font-size: 24px;
			font-weight: 500;
			margin-bottom: 20px;
		}
		button {
			background-color: #0467DB;
			border: none;
			border-radius: 5px;
			color: #FFF;
			cursor: pointer;
			font-size: 18px;
			font-weight: 500;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			transition: background-color 0.3s ease-in-out;
			width: 200px;
			margin-bottom: 20px;
		}
		button:hover {
			background-color: #033F8B;
		}
		p {
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Tu archivo está listo para descargar</h1>
		<p>¡Hola!</p>
		<p>Tu archivo está listo para descargar. Para descargarlo, simplemente haz clic en el botón que aparece a continuación:</p>
		<a href=' . base_url('exportar-excel/validar/' . $token) . ' class="btn btn-primary" download>Descargar archivo</a>
		<p>Si el botón no funciona, también puedes descargar el archivo directamente desde este enlace:</p>
		<p>Recuerda que el enlace expirará en 1 día, así que asegúrate de descargar el archivo antes de que expire.</p>
		<p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos. ¡Gracias por utilizar nuestro servicio!</p>
		<p>Saludos cordiales,<br>' . NOMBRE_EMPRESA . '</p>
	</div>
</body>
</html>

	';
	return $mensaje;
}

function genera_excel($data, $empresa_id)
{
	// Crear un nuevo objeto Spreadsheet
	$spreadsheet = new Spreadsheet();
	$format = 'Y-m-d\TH:i:sP';

	// Seleccionar la primera hoja de cálculo
	$sheet = $spreadsheet->getActiveSheet();

	// Escribir los datos en la hoja de cálculo
	$rowIndex = 1;
	foreach ($data as $row) {
		//pre_die($row);
		$columnIndex = 'A';
		foreach ($row as $key => $cellValue) {
			$sheet->setCellValue($columnIndex . $rowIndex, strUpper($key));
			$columnIndex++;
		}
	}
	$rowIndex++;
	foreach ($data as $row) {
		$columnIndex = 'A';
		foreach ($row as $cellValue) {

			if (is_object($cellValue)) {
				$sheet->setCellValue($columnIndex . $rowIndex, $cellValue->format('d-m-Y'));
			} else if (is_string($cellValue)) {
				$sheet->setCellValue($columnIndex . $rowIndex, strUpper(
					ENVIRONMENT == 'development' ? utf8_encode($cellValue) :
						mb_convert_encoding($cellValue, 'utf-8')
				));
			} else {
				$sheet->setCellValue($columnIndex . $rowIndex, $cellValue);
			}
			$columnIndex++;
		}
		$rowIndex++;
	}

	// Crear un objeto Writer para escribir el archivo Excel
	$writer = new Xlsx($spreadsheet);

	// Guardar el archivo en la carpeta temporal
	$random = rand(111111, 999999);
	$filename = 'Documento_' . $random . '.xlsx';
	$url = ROOT_PATH_BASE . '/docs/empresas/empresa_' . $empresa_id . '/documentos/';
	//pre_die($url);
	if (is_dir($url)) {
		$url_base = $url . $filename;
	} else {
		mkdir($url, 0777, TRUE);
		//chmod($url, 0777);
		$url_base = $url . $filename;
	}
	$tempPath = $url_base;
	$writer->save($tempPath);
	return ['url' => $url_base, 'filename' => $filename];
}
function generaExcelCSV($data, $empresa_id, $porLote = 100)
{
	$random = rand(111111, 999999);
	$filename = 'Documento_' . $random . '.csv';

	$url = ROOT_PATH_BASE . '/docs/empresas/empresa_' . $empresa_id . '/documentos/';

	if (!is_dir($url)) {
		mkdir($url, 0777, true);
	}

	$url_base = $url . $filename;

	try {
		$spreadsheet = new Spreadsheet();
		$format = 'Y-m-d\TH:i:sP';

		$sheet = $spreadsheet->getActiveSheet();
		$columnIndex = 'A';

		// Write headers
		$csvRow = [];
		$csvRow[] = is_array(array_keys($data[0])) ? convertirArraysATextoCSV(array(array_keys($data[0]))) : array_keys($data[0]);
		$sheet->setCellValue($columnIndex . '1', strUpper($csvRow[0]));

		//$columnIndex++;
		$rowIndex = 2;
		foreach ($data as $row) {
			$columnIndex = 'A';
			$values = [];
			$row = formatArray($row);
			foreach ($row as $cellValue) {
				if (is_string($cellValue)) {
					$cellValue = ENVIRONMENT == 'development' ? utf8_encode($cellValue) : mb_convert_encoding($cellValue, 'utf-8');
				}
				$values[] = $cellValue;
			}
			//$columnIndex++;
			$csvRow = is_array($values) ? convertirArraysATextoCSV(array($values)) : $values;
			$sheet->setCellValue($columnIndex . $rowIndex, $csvRow);
			$rowIndex++;
		}

		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
		$writer->setDelimiter(';');
		$writer->setEnclosure('"');
		$writer->setLineEnding("\r\n");
		$writer->setSheetIndex(0);
		$writer->save($url_base);
		return ['url' => $url_base, 'filename' => $filename];
	} catch (Exception $e) {
		ob_clean(); // Limpiar el buffer de salida
		echo "Error al crear el archivo: " . $e->getMessage();
	}
}
function convertirArraysATextoCSV($arrays)
{
	$texto_delimitado = array();
	foreach ($arrays as $array) {
		$valores_escapados = array_map(function ($valor) {
			return '"' . str_replace('"', '""', $valor) . '"';
		}, $array);

		$texto_delimitado[] = implode(',', $valores_escapados);
	}
	return implode("\n", $texto_delimitado);
}

function escribirLoteEnArchivo($archivo, $lote)
{
	$cont = 1;
	foreach ($lote as $row) {
		$archivo->fputcsv($row);
	}
}


function exportaExcel($link_base, $filename)
{


	// Comprueba si el archivo existe
	if (file_exists($link_base)) {

		// Establece las cabeceras para forzar la descarga del archivo
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		if (!headers_sent()) {
			// Obtiene el tamaño del archivo
			$filesize = filesize($link_base);

			// Envía el archivo al navegador
			$bytesSent = readfile($link_base);

			// Verifica si el número de bytes enviados coincide con el tamaño del archivo
			if ($bytesSent === $filesize) {
				// La descarga se ha realizado correctamente
				exit;
			} else {
				pre_die('NEL');
				//				echo 'Error al descargar el archivo.';
				return false;
			}
		} else {
			//			echo 'No se pudo iniciar la descarga del archivo.';
			return false;
		}
		// Envía el archivo al navegador
		/*		readfile($link_base);
		exit;*/
	} else {
		// El archivo no existe
		//echo 'El archivo no existe.';
		return false;
	}
}

function validaIcon($id, $card = false)
{
	if ($card) {
		switch ($id) {
			case '7':
				$icon = ASSETS_IMAGES . 'iconos/info.png';
				break;
			case '8':
				$icon = ASSETS_IMAGES . 'iconos/hand-holding-usd.png';
				break;
			case '9':
				$icon = ASSETS_IMAGES . 'iconos/compras.png';
				break;
			default:
				$icon = ASSETS_IMAGES . 'iconos/info.png';
				break;
		}
	} else {
		switch ($id) {
			case '1':
				$icon = ASSETS_IMAGES . 'iconos/finanzas.png';
				break;
			case '2':
				$icon = ASSETS_IMAGES . 'iconos/inventario.png';
				break;
			case '3':
				$icon = ASSETS_IMAGES . 'iconos/ventas.png';
				break;
			case '4':
				$icon = ASSETS_IMAGES . 'iconos/compras.png';
				break;

			default:
				$icon = ASSETS_IMAGES . 'iconos/info.png';
				break;
		}
	}
	return $icon;
}
function eliminarTop($query)
{
	$query = strLower($query);
	$patron = '/\bselect top \d+\b/i';
	$patron2 = "/select\s+\*/i";
	if (preg_match($patron2, $query)) {
		$querySinTop = preg_replace($patron, 'select top 5000 *', $query);
	} else if (preg_match($patron, $query)) {
		$querySinTop = preg_replace($patron, 'select', $query);
	}

	return $querySinTop;
}

function validaTop($query)
{


	$query = strLower($query);
	$data = [];
	$patron = "/select\s+\*/i";
	if (preg_match($patron, $query)) {
		$data = [
			'query' => str_replace('select *', "SELECT TOP 10 *", $query),
			'match' => '10'
		];
	} else if (preg_match('/\bselect top \d+\s*\*/i', $query)) {
		$data = [
			'query' => preg_replace('/select top \d+/i', "SELECT TOP 10", $query),
			'match' => '10'
		];
	} else if (preg_match('/\bselect top (\d+)\b/i', $query, $matches)) {
		$top_value = intval($matches[1]);
		if ($top_value > 10) {
			$data = [
				'query' => preg_replace('/select top \d+/i', 'SELECT TOP 10', $query),
				'match' => '10'
			];
		} else {
			$data = [
				'query' => $query,
				'match' => ''
			];
		}
	} else if (!preg_match('/\bselect\s+(top\s+\d+|\*)\s+/i', $query)) {
		$data = [
			'query' => str_replace('select', "SELECT TOP 10", $query),
			'match' => '10'
		];
	} else {
		$data = [
			'query' => $query,
			'match' => ''
		];
	}
	//pre_die($data);
	return $data;
}
function validaTopX($query, $top_limit = 20000)
{
	$query = strtolower($query);
	$data = [];

	// Establecer el valor del TOP deseado
	//$top_limit = 30000;
	//pre($query);
	if (preg_match('/\bselect\s+\*/i', $query)) {
		$data = [
			'query' => preg_replace('/\bselect\s+\*/i', "SELECT TOP {$top_limit} *", $query),
			'match' => $top_limit
		];
	} else if (preg_match('/\bselect\s+top\s+\d+\s*\*/i', $query)) {
		$data = [
			'query' => preg_replace('/\bselect\s+top\s+\d+\s*\*/i', "SELECT TOP {$top_limit} *", $query),
			'match' => $top_limit
		];
	} else if (preg_match('/\bselect\s+top\s+(\d+)\b/i', $query, $matches)) {
		$top_value = intval($matches[1]);
		$data = [
			'query' => preg_replace('/\bselect\s+top\s+\d+\b/i', "SELECT TOP {$top_limit}", $query),
			'match' => $top_limit
		];
	} else if (!preg_match('/\bselect\s+(top\s+\d+|\*)\s+/i', $query)) {
		$data = [
			'query' => preg_replace('/\bselect\b/i', "SELECT TOP {$top_limit}", $query),
			'match' => $top_limit
		];
	} else {
		$data = [
			'query' => $query,
			'match' => ''
		];
	}

	return $data;
}






function validaTop1000($query)
{


	$query = strLower($query);
	$data = [];
	$patron = "/select\s+\*/i";
	if (preg_match($patron, $query)) {
		$data = [
			'query' => str_replace('select *', "SELECT TOP 10 *", $query),
			'match' => '10'
		];
	} else if (preg_match('/\bselect top \d+\s*\*/i', $query)) {
		$data = [
			'query' => preg_replace('/select top \d+/i', "SELECT TOP 1000", $query),
			'match' => '1000'
		];
	} else if (preg_match('/\bselect top (\d+)\b/i', $query, $matches)) {
		$top_value = intval($matches[1]);
		if ($top_value > 1000) {
			$data = [
				'query' => preg_replace('/select top \d+/i', 'SELECT TOP 1000', $query),
				'match' => '1000'
			];
		} else {
			$data = [
				'query' => $query,
				'match' => ''
			];
		}
	} else if (!preg_match('/\bselect\s+(top\s+\d+|\*)\s+/i', $query)) {
		$data = [
			'query' => str_replace('select', "SELECT TOP 1000", $query),
			'match' => '1000'
		];
	} else {
		$data = [
			'query' => $query,
			'match' => ''
		];
	}
	//pre_die($data);
	return $data;
}
function validaTopExporta($query)
{
	$query = strLower($query);
	$data = [];
	$patron = "/select\s+\*/i";
	if (preg_match($patron, $query)) {
		$data = str_replace('select *', "SELECT TOP 250 *", $query);
	} else if (!preg_match('/\bselect top\b/i', $query)) {
		$data = str_replace('select', "SELECT TOP 1000 ", $query);
	} else {
		$data = $query;
	}
	//pre_die($data);
	return $data;
}
function exception_handler($exception)
{
	echo "<h1>Failure</h1>";
	echo "Uncaught exception: ", $exception->getMessage();
}
function removeTopFromQuery($query)
{
	// Expresión regular para buscar una cláusula TOP en la consulta
	$pattern = '/\bselect\s+top\s+(\d+)\b/i';

	// Reemplazar la cláusula TOP con una cadena vacía
	$cleanQuery = preg_replace($pattern, 'select', $query);

	return $cleanQuery;
}

function ajustarQuery($query)
{
	$query = strUpper($query);
	// Verificar si la consulta principal tiene una cláusula "SELECT *"
	if (preg_match('/SELECT\s+\*\s+FROM\s+/i', $query)) {
		// Reemplazar "SELECT *" por "SELECT TOP 10 *"
		$query = preg_replace('/SELECT\s+\*\s+FROM\s+/i', 'SELECT TOP 10 * FROM ', $query);
		$match = 10;
	}
	// Verificar si la consulta principal tiene una cláusula "SELECT * TOP X"
	elseif (preg_match('/SELECT\s+\*\s+TOP\s+\d+\s+FROM\s+/i', $query)) {
		// Reemplazar "SELECT * TOP X" por "SELECT TOP 2000 *"
		$query = preg_replace('/SELECT\s+\*\s+TOP\s+\d+\s+FROM\s+/i', 'SELECT TOP 2000 * FROM ', $query);
		$match = 2000;
	}

	// Buscar subconsultas y aplicar la misma lógica recursivamente
	preg_match_all('/\((SELECT\s+.*\s+FROM\s+.*)\)/i', $query, $subqueries);
	foreach ($subqueries[1] as $subquery) {
		$subqueryModificado = ajustarQuery($subquery);
		$query = str_replace($subquery, $subqueryModificado['query'], $query);
	}


	return
		[
			'query' => $query,
			'match' => !empty($match) ? $match : 0
		];
}
function formatoConnect($data)
{
	$db = [
		'hostname' => $data['hostname'],
		'username' => $data['user_database'],
		'database' => $data['name_database'],
		'DBDriver'    => 'SQLSRV',
		'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
		'pConnect'    => false,
		'DBDebug'     => true,
		'charset'     => 'utf8',
		'DBCollat'    => 'utf8_general_ci',
		'swapPre'     => '',
		'encrypt'     => false,
		'compress'    => false,
		'strictOn'    => false,
		'failover'    => [],
		'port'        => $data['puerto'],
		'foreignKeys' => true,
		'busyTimeout' => 1000,
	];
	if (is_base64_encoded($data['password_database'])) {
		$db['password'] = base64_decode($data['password_database']);
	} else {
		$db['password'] = $data['password_database'];
	}
	return $db;
};
function validaDataBase($data, $valida = false)
{
	if (!is_array($data)) {
		$data = (array)$data;
	}
	$host = $data['hostname'];
	$dbname = $data['name_database'];
	$username = $data['user_database'];
	$password = is_base64_encoded($data['password_database']) ? base64_decode($data['password_database']) : $data['password_database'];
	$puerto = $data['puerto'];

	$conn = false;
	//pre_die($_SERVER);
	try {
		if ($_SERVER['HTTP_HOST'] == 'localhost:82') {
			$conn = new PDO("sqlsrv:server=$host;database=$dbname", $username, $password);
		} else {
			$conn = new PDO("dblib:host=$host;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->setAttribute(PDO::ATTR_TIMEOUT, 0);
		}
	} catch (PDOException $exp) {
		$conn = false;
	}
	return $conn;
}

function formatErrors($errors)
{
	// Display errors
	echo "<h1>SQL Error:</h1>";
	echo "Error information: <br/>";
	foreach ($errors as $error) {
		echo "SQLSTATE: " . $error['SQLSTATE'] . "<br/>";
		echo "Code: " . $error['code'] . "<br/>";
		echo "Message: " . $error['message'] . "<br/>";
	}
}
function compararPorNColumna($a, $b)
{
	return $a['n_columna'] - $b['n_columna'];
}
function compararPorNColumnaObject($a, $b)
{
	return $a->n_columna - $b->n_columna;
}
function ordenar_stock($a, $b)
{
	if ($a['Stock a la fecha inicio'] == $b['Stock a la fecha inicio']) {
		return 0;
	}
	return ($a['Stock a la fecha inicio'] < $b['Stock a la fecha inicio']) ? 1 : -1;
}
function formatArrayExportar($array)
{
	$formattedArray = [];
	foreach ($array as $key => $value) {
		if (formatearFecha($value)) {
			$formattedArray[$key] = formatearFecha($value);
		} else if (is_numeric($value)) {
			$formattedArray[$key] = round($value);
		} else if (empty($value)) {
			$formattedArray[$key] = utf8_encode("SIN INFORMACION");
		} else {
			$string = $value;
			$string = str_replace(array("\r", "\n"), ' ', $string);
			$string = strUpper(mb_convert_encoding((trim($string)), 'utf-8'));

			// Agrega la validación para reemplazar caracteres
			$string = str_replace(',', '.', $string);
			$string = str_replace(';', ':', $string);

			$formattedArray[$key] = $string;
		}
	}
	return $formattedArray;
}

function formatArray($array)
{
	$formattedArray = [];

	foreach ($array as $key => $value) {
		if (formatearFecha($value)) {
			$formattedArray[$key] = formatearFecha($value);
		} else if (is_numeric($value)) {
			$formattedArray[$key] = round($value);
		} else if (empty($value)) {
			$formattedArray[$key] = "SIN INFORMACION";
		} else {
			//pre_die(ENVIRONMENT);
			if (mb_detect_encoding($value, 'UTF-8', true) !== 'UTF-8') {
				$utf8String = (ENVIRONMENT == 'development' ? utf8_encode($value) : mb_convert_encoding($value, 'utf-8'));
			} else {
				$utf8String = $value;
			}
			$formattedArray[$key] = strUpper($utf8String);
		}
	}

	return $formattedArray;
}
function formatearFecha($fecha)
{
	//pre_die($fecha);
	$fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
	if ($_SERVER['HTTP_HOST'] == 'localhost:82') {
		$fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s.u', $fecha);
	}

	if ($fechaObjeto) {
		return $fechaObjeto->format('Y-m-d');
	} else {
		return false; // Manejar error si la cadena no tiene el formato esperado
	}
}

function utf8_encode_final($string)
{
	if (mb_detect_encoding($string, 'UTF-8', true) !== 'UTF-8') {
		$string = (ENVIRONMENT == 'development' ? utf8_encode($string) : mb_convert_encoding($string, 'utf-8'));
	} else {
		$string = $string;
	}

	return $string;
}


function formatearCampos($value)
{
	$array = [];
	if (!empty($value)) {
		foreach ($value as $key => $v) {

			if (empty($v)) {

				$array[$key] = [
					'value' => 'SIN INFORMACION',
					'align_column' => 'text-left'
				];
			} elseif (formatearFecha($v)) {
				$array[$key] = [
					'value' => formatearFecha($v),
					'align_column' => 'text-left'
				];
			} else if (is_numeric($v)) {

				if ($key == 'Año' || $key == 'AÑO' || $key == 'año') {
					$va = round($v);
				} else if ($key == 'docnum' || $key == 'folionum') {
					$va = round($v);
				} else {
					$va = formatear_miles((int)($v));
				}
				$array[$key] = [
					'value' => $va,
					'align_column' => 'text-right'
				];
			} else if (is_string($v)) {

				if (mb_detect_encoding($v, 'UTF-8', true) !== 'UTF-8') {
					$utf8String = (ENVIRONMENT == 'development' ? utf8_encode($v) : mb_convert_encoding($v, 'utf-8'));
				} else {
					$utf8String = $v;
				}
				$array[$key] = [
					'value' =>  strUpper($utf8String),
					'align_column' => 'text-left'
				];
			}
		}
		return $array;
	} else {
		return false;
	}
}
function eliminarArchivoTemporal($archivo)
{
	if (file_exists($archivo)) {
		unlink($archivo);
	}
}
function comparar_fechas($a, $b)
{
	$fecha_a = $a['fecha_vence']->format('Y-m-d');
	$fecha_b = $b['fecha_vence']->format('Y-m-d');
	if ($fecha_a == $fecha_b) {
		return 0;
	}
	return ($fecha_a < $fecha_b) ? -1 : 1;
}
function ValidateConnectDb($db)
{
	$db      = \Config\Database::connect();
	$builder = $db->table('perfiles');
	$perfil = $builder->getWhere(['id' => $perfil_id])->getRowArray();
	//$perfil = get_row_by_where('perfiles', ['id' => $perfil_id]);
	//pre_die($perfil);
	if (!empty($perfil)) {
		return $perfil['nombre'];
	} else {
		return false;
	}
}
function ValidatePerfil($perfil_id)
{
	$db      = \Config\Database::connect();
	$builder = $db->table('perfiles');
	$perfil = $builder->getWhere(['id' => $perfil_id])->getRowArray();
	//$perfil = get_row_by_where('perfiles', ['id' => $perfil_id]);
	//pre_die($perfil);
	if (!empty($perfil)) {
		return $perfil['nombre'];
	} else {
		return false;
	}
}

function validateEmail($email)
{
	if ((strlen($email) > 96) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}
//Validate text/String 
function validateText($text)
{
	if ((strlen($text) < 2) || !is_string($text)) {
		return true;
	} else {
		return false;
	}
}
function validatePassword($text)
{
	if ((strlen($text) < 4)) {
		return true;
	} else {
		return false;
	}
}
//Validate Date
function validateDate($date, $format = 'Y-m-d')
{
	if (validateDateFormat($date, $format)) {
		return false;
	} else {
		return true;
	}
}
//Validate Date format
function validateDateFormat($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

function validateRut($rut)
{
	$r = strtoupper(preg_replace('/[^Kk0-9]/i', '', $rut));
	if (strlen($r) < 7) {
		return false;
	}
	$sub_rut = substr($r, 0, strlen($r) - 1);
	$sub_dv = substr($r, -1);
	$x = 2;
	$s = 0;
	for ($i = strlen($sub_rut) - 1; $i >= 0; $i--) {
		if ($x > 7) {
			$x = 2;
		}
		$s += $sub_rut[$i] * $x;
		$x++;
	}
	$dv = 11 - ($s % 11);
	if ($dv == 10) {
		$dv = 'K';
	}
	if ($dv == 11) {
		$dv = '0';
	}
	if ($dv == $sub_dv) {
		return true;
	} else {
		return false;
	}
}

function validateUltimoDiaMes($date)
{
	echo $date . "<br>";
	$date = explode('-', $date);
	$dia = $date[2];
	$mes = $date[1];
	$ano = $date[0];
	#$date = $ano.'-'.$mes.'-'.$dia;
	$resp = false;

	while (!$resp) {
		if (!checkdate($mes, $dia, $ano)) {
			#$date = explode('-', $date);
			$dia = $dia - 1;
			$mes = $mes;
			$ano = $ano;
			$date = $ano . '-' . $mes . '-' . $dia;
			#echo $date."<br>";
			$resp = false;
		} else {
			$date = $ano . '-' . $mes . '-' . $dia;
			$resp = true;
		}
	}
	echo $date;
	die();
	return date('Y-m-d', strtotime($date));
}

function str_limit($value, $limit = '', $end = '')
{
	if (empty($limit)) {
		$limit = 100;
	}
	if (mb_strwidth($value, 'UTF-8') <= $limit) {
		return $value;
	}
	return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
}

function IssuperAdmin()
{
	if (USUARIO_ROL != 1) {
		redirect(base_url());
	}
}
function IsUsuario()
{
	if (USUARIO_ROL >= 4) {
		redirect(base_url('dashboard'));
	}
}
function IsCliente()
{
	if (USUARIO_ROL == 4) {
		redirect(base_url('acceso-clientes/'));
	}
}
function formateaRut($rut)
{
	//pre($rut);
	//$rut = '20833673‑8';
	$rutLimpio = custom_str_replace($rut, '.', '');
	$rutLimpio = custom_str_replace($rutLimpio, '-', '');
	$rutLimpio = custom_str_replace($rutLimpio, '‑', '');

	$dvRut = substr($rutLimpio, -1);
	$rutLimpio = substr($rutLimpio, 0, -1);
	$rutFormateado = formatear_miles($rutLimpio) . '-' . $dvRut;
	return $rutFormateado;
}
function formateaCuit($cuit)
{
	//pre_die($cuit);
	$cuitLimpio = str_replace('.', '', $cuit);
	$cuitLimpio = trim(str_replace('-', '', $cuitLimpio));
	$dvCuit = substr($cuitLimpio, -1);
	//pre_die($dvRut);
	$nInicio = substr($cuitLimpio, 0, 2);
	//pre_die($nInicio);
	$cuitLimpio = substr($cuitLimpio, 2, -1);
	$cuitFormateado = $nInicio . '-' . formatear_miles($cuitLimpio) . '-' . $dvCuit;
	return $cuitFormateado;
}

function formatear_numero($numero)
{
	if (!empty($numero)) {
		$pesos = '$ ' . number_format($numero, 0, ',', '.');
	} else {
		$pesos = "No aplica";
	}
	return $pesos;
}
function formatear_numero_query($numero)
{
	if (!empty($numero)) {
		$pesos = '$ ' . number_format($numero, 0, ',', '.');
	} else {
		$pesos = '$0';
	}
	return $pesos;
}
function formatear_miles($numero)
{
	if (!empty($numero)) {
		$pesos = '' . number_format($numero, 0, ',', '.');
	} else {
		$pesos = '0';
	}
	return $pesos;
}
function formatear_miles_query($numero)
{
	if (!empty($numero)) {
		$pesos = '' . number_format($numero, 0, ',', '');
	} else {
		$pesos = $numero;
	}
	return $pesos;
}
function custom_str_replace($original, $search, $replace)
{
	$result = '';
	$length = strlen($original);
	$search_length = strlen($search);

	for ($i = 0; $i < $length; $i++) {
		if (substr($original, $i, $search_length) === $search) {
			$result .= $replace;
			$i += $search_length - 1; // Skip characters in the original string
		} else {
			$result .= $original[$i];
		}
	}

	return $result;
}

function soloNumeros($numero)
{
	if (!empty($numero)) {
		$num = str_replace('.', '', $numero);
		$num = str_replace('-', '', $num);
	} else {
		$num = "No aplica";
	}
	return $num;
}
function formatear_porcentaje($numero)
{

	if (!empty($numero)) {
		if (!is_float($numero)) {
		}
		$porcentaje = str_replace('.', ',', $numero) . ' %';
	} else {
		$porcentaje = "No aplica";
	}
	return $porcentaje;
}
function crear_carpeta($carpeta)
{
	$ruta_contenido = ROOT_PATH_BASE . "/assets/uploads/$carpeta/";
	if ($ruta_contenido) {
		return $ruta_contenido;
	} else {
		mkdir($ruta_contenido, 0755, TRUE);
		return $ruta_contenido;
	}
}
function crear_carpeta_upload($articulo_id, $prefix)
{
	$ruta_contenido = ROOT_PATH_BASE . '/uploads/' . $prefix . $articulo_id . '/';

	if (is_dir($ruta_contenido)) {
		return $ruta_contenido;
	} else {
		mkdir($ruta_contenido, 0755, TRUE);
		return $ruta_contenido;
	}
}
function encriptar_b64($dato_encriptado)
{
	$clave  = 'hitch';
	$method = 'RC2-64-CBC';
	$iv = base64_decode("6xeYtnPoXCs=");
	$encriptar = function ($valor) use ($method, $clave, $iv) {
		return openssl_encrypt($valor, $method, $clave, false, $iv);
	};
	return $encriptar($dato_encriptado);
}
function desencriptar_b64($dato_encriptado)
{

	if (!empty($dato_encriptado) && $dato_encriptado != 'SIN CLAVE UNICA') {
		$clave  = 'hitch';
		$method = 'RC2-64-CBC';
		$iv = base64_decode("6xeYtnPoXCs=");
		$desencriptar = function ($valor) use ($method, $clave, $iv) {
			$encrypted_data = base64_decode($valor);
			return openssl_decrypt($valor, $method, $clave, false, $iv);
		};
		if (!$desencriptar($dato_encriptado)) {
			return $dato_encriptado;
		} else {
			return $desencriptar($dato_encriptado);
		}
	} else {
		return 'error';
	}
}

function getUsuario($id)
{
	$usuario = get_row_by_where('usuarios', ['id' => $id]);
	if (!empty($usuario)) {
		return $usuario->nombre;
	} else {
		return 'Sin información';
	}
}

function strUpper($str)
{
	$str = strtoupper(trim($str));
	$str = str_replace('á', 'Á', $str);
	$str = str_replace('é', 'É', $str);
	$str = str_replace('í', 'Í', $str);
	$str = str_replace('ó', 'Ó', $str);
	$str = str_replace('ú', 'Ú', $str);
	$str = str_replace('ñ', 'Ñ', $str);
	return $str;
}

function strLower($str)
{
	$str = strtolower(trim($str));
	$str = str_replace('Á', 'á', $str);
	$str = str_replace('É', 'é', $str);
	$str = str_replace('Í', 'í', $str);
	$str = str_replace('Ó', 'ó', $str);
	$str = str_replace('Ú', 'ú', $str);
	$str = str_replace('Ñ', 'ñ', $str);
	return $str;
}

function getUrl($str)
{
	$str = strLower(trim($str));

	$str = limpiarStr($str);
	$str = preg_replace('([^A-Za-z0-9])', '-', $str);
	return $str;
}
function limpiarStr($str)
{
	$str = trim($str);
	$str = str_replace('á', 'a', $str);
	$str = str_replace('é', 'e', $str);
	$str = str_replace('í', 'i', $str);
	$str = str_replace('ó', 'o', $str);
	$str = str_replace('ú', 'u', $str);
	$str = str_replace('ñ', 'n', $str);
	return $str;
}
function limpiarMoneda($str)
{
	$str = trim($str);
	$str = str_replace('$', '', $str);
	$str = str_replace('.', '', $str);
	$str = preg_replace('([^0-9])', '', $str);
	return $str;
}


function getToken()
{
	return sha1(mt_rand());
}

function is_base64_encoded($str)
{

	$decoded_str = base64_decode($str);
	$Str1 = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $decoded_str);
	if ($Str1 != $decoded_str || $Str1 == '') {
		return false;
	}
	return true;
}

function saludo()
{
	$saludo = 'Bienvenido ';
	$hora = date('H');
	$horario_dia   = ['05', '06', '07', '08', '09', '10', '11'];
	$horario_tarde = ['12', '13', '14', '15', '16', '17', '18', '19', '20', '21'];
	$horario_noche = ['22', '23', '00', '01', '02', '03', '04'];
	if (in_array($hora, $horario_dia)) {
		$saludo = 'Buenos Días ';
	}
	if (in_array($hora, $horario_tarde)) {
		$saludo = 'Buenas Tardes ';
	}
	if (in_array($hora, $horario_noche)) {
		$saludo = 'Buenas Noches ';
	}
	//pre_die($saludo);
	return $saludo;
}

function icono_extension($nombre)
{
	$ext_file = pathinfo($nombre, PATHINFO_EXTENSION);

	$icon = null;
	switch ($ext_file) {
		case 'txt':
			$icon = 'fa fa-file-o';
			break;

		case 'pdf':
			$icon = 'fa fa-file-pdf-o';
			break;

		case 'png' || 'PNG' || 'jpg' || 'JPG' || 'webp':
			$icon = 'fa fa-file-image-o';
			break;

		default:
			$icon = 'fa fa-file-o';
			break;
	}
	return $icon;
}

function tieneOrderBy($query)
{
	// Convertimos la consulta a minúsculas para hacer la búsqueda insensible a mayúsculas/minúsculas
	$queryLowerCase = strtolower($query);

	// Buscamos la cadena "order by" en la consulta
	if (strpos($queryLowerCase, "order by") !== false) {
		return true;
	} else {
		return false;
	}
}
function removeOrderBy($query)
{
	$posicionPuntoYComa = strpos($query, ";");

	// Si se encuentra el punto y coma, quitarlo y retornar la query modificada
	if ($posicionPuntoYComa !== false) {
		$query = substr_replace($query, "", $posicionPuntoYComa, 1);
	}

	$pattern = '/\s+ORDER\s+BY\s+[^;]*$/i';
    $queryWithoutOrderBy = preg_replace($pattern, '', $query);
    return $queryWithoutOrderBy;
}

function obtenerEmpresaUsuario($id)
{
	$db      = \Config\Database::connect();
	$empresa = $db->table('empresas');
	$empresa_usuario = $empresa->getWhere(['id' => $id, 'eliminado' => false])->getRowObject();

	return $empresa_usuario;
}

function removeOrderBy2($inputQuery)
{
	$posicionPuntoYComa = strpos($inputQuery, ";");

	// Si se encuentra el punto y coma, quitarlo y retornar la query modificada
	if ($posicionPuntoYComa !== false) {
		$inputQuery = substr_replace($inputQuery, "", $posicionPuntoYComa, 1);
	}

	// Utilizamos una expresión regular para buscar la cláusula "ORDER BY" en la consulta
	$pattern = '/\s+order\s+by\s+(.*?)(?=(?:limit|offset|$))/i';
	$queryWithoutOrderBy = preg_replace($pattern, '', $inputQuery);
	/*pre($queryWithoutOrderBy);
	pre_die($pattern);*/

	return $queryWithoutOrderBy;
}

function findAndExtractDeclarations($inputString)
{
	$matches = [];
	preg_match_all('/(declare|set)(.*?);/', $inputString, $matches);

	$declarations = [];
	$sets = [];

	foreach ($matches[0] as $index => $match) {
		$declarationType = $matches[1][$index];
		$declaration = trim(str_replace($declarationType, "", $match, $count));

		if ($declarationType === "declare") {
			$declarations[] = $declaration;
		} elseif ($declarationType === "set") {
			$sets[] = $declaration;
		}
	}

	$cleanedInputString = preg_replace('/(declare|set)(.*?);/', '', $inputString);

	return [
		'declare' => $declarations,
		'set' => $sets,
		'cleanedInput' => trim($cleanedInputString)
	];
}

function generarScript($declareArray, $setArray)
{
	$result = "declare";
	foreach ($declareArray as $declare) {
		$result .= "\t" . $declare . "\n";
	}

	//$result .= "\nset\n";
	foreach ($setArray as $set) {
		$result .= "set " . $set . "\n";
	}

	return $result;
}
