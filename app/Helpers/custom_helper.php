<?php
require_once('sendgrid-php/sendgrid-php.php');

use SendGrid\Mail\Mail;


function getNombreCompletoCliente($cliente_id)
{
	$db = \Config\Database::connect();

	// Se obtiene una referencia a la tabla 'pagos_venta'
	$table = $db->table('clientes c');
	$table->select('CONCAT(c.nombre, " ", COALESCE(c.apellido_paterno, ""), " ", COALESCE(c.apellido_materno, "")) as nombre_cliente', false);
	$dataCliente = $table->getWhere([
		'c.estado'      => true,
		'c.eliminado'   => false,
		'c.id'          => $cliente_id,
	])->getRowObject();

	return $dataCliente ?? null;
}

function GetCarteraCliente($cliente_id)
{
	// Se establece la conexión a la base de datos
	$db = \Config\Database::connect();

	// Se obtiene una referencia a la tabla 'pagos_venta'
	$table = $db->table('ventas v');
	$table->select('sum(v.total_venta) as total_compra, sum(v.total_pagado) as total_pagado, count(*) as total_ventas');
	$dataCliente = $table->getWhere([
		'v.estado'               => true,
		'v.eliminado'            => false,
		'v.cliente_id'            => $cliente_id,
	])->getRowObject();

	if (!empty($dataCliente)) {
		return $dataCliente;
	} else {
		return NULL;
	}
}
function GetPagosVentaYFiados($ruta_id)
{
	// Se establece la conexión a la base de datos
	$db = \Config\Database::connect();

	// Se obtiene una referencia a la tabla 'pagos_venta'
	$table = $db->table('pagos_venta');
	$table->select('sum(monto_pago_actual) as fiado_pagado_ruta');
	$dataFiados = $table->getWhere([
		// 'estado'               => true,
		// 'eliminado'            => false,
		'ruta_id_fiado_pagado' => $ruta_id
	])->getRowObject();

	// Se verifica si se encontraron registros
	if (!empty($dataFiados)) {
		// Si se encontraron registros, se devuelven
		return $dataFiados;
	} else {
		// Si no se encontraron registros, se devuelve NULL
		return NULL;
	}
}

function GetObjectByWhere($table, $where)
{
	$db      = \Config\Database::connect();
	$table = $db->table($table);
	$data = $table->getWhere($where)->getResultObject();
	if (!empty($data)) {
		return $data;
	} else {
		return NULL;
	}
}
function GetRowObjectByWhere($table, $where)
{
	$db      = \Config\Database::connect();
	$table = $db->table($table);
	$data = $table->getWhere($where)->getRowObject();
	if (!empty($data)) {
		return $data;
	} else {
		return '';
	}
}

function InsertRowTable($table, $data)
{
	$db = \Config\Database::connect();
	$builder = $db->table($table);

	//Insert the data into the table
	$inserted = $builder->insert($data);

	if ($inserted) {
		//Retrieve the last inserted ID and return the inserted row
		$lastInsertedID = $db->insertID();
		return $lastInsertedID;
	} else {
		return 'Sin información';
	}
}
function UpdateRowTableByWhere($table, $data, $where)
{
	$db = \Config\Database::connect();
	$builder = $db->table($table);

	// Add the WHERE condition
	$builder->where($where);

	// Update the data in the table
	$updated = $builder->update($data);

	if ($updated) {
		// If the update was successful, return the updated row ID
		return $updated;
	} else {
		// If the update failed, return an error message
		return 'Sin información';
	}
}


function GetRepartidor($usuario_id)
{
	$db      = \Config\Database::connect();
	$table = $db->table('usuarios');
	$data = $table->getWhere(['estado' => true, 'eliminado' => false, 'id' => $usuario_id])->getRowObject();
	// pre_die($data);
	if (!empty($data)) {
		return $data;
	} else {
		return [];
	}
}




function GetObjectRowByWhere($table, $where)
{
	$db      = \Config\Database::connect();
	$table = $db->table($table);
	$data = $table->getWhere($where)->getRowObject();
	if (!empty($data)) {
		return $data;
	} else {
		return 'Sin información';
	}
}




function templateCorreo($nombreUsuario, $token)
{
	$cuerpoCorreo = "
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Restablecimiento de Contraseña</title>
        </head>
        <body>

        <p><strong>Estimado/a $nombreUsuario,</strong></p>

        <p>Recibimos una solicitud de restablecimiento de contraseña para tu cuenta en huevoslocos. Haz clic en este <a href='" . base_url('new-password/' . $token) . "'>enlace</a> para cambiar tu contraseña.</p>

        <p>Si no solicitaste esto, por favor ignora este mensaje.</p>

        <p>Atentamente,<br>
            Soporte<br>
            HighDevs
        </p>

        </body>
        </html>
    ";

	return $cuerpoCorreo;
}

function enviarCorreoMail($data_mail, $debug = false, $adjunto = NULL, $fileType = 'pdf')
{


	$mensaje = $data_mail['mensaje'];
	$asunto = $data_mail['asunto'];
	$para = $data_mail['para'];
	//  $para = 'yugitomatabi@gmail.com';
	$de = $data_mail['remitente'];


	// error_log('que paso1'.print_r(json_encode($data_mail['attach']), true));
	//error_log('que paso2'.print_r(json_encode(base_url().'cargar/pdf/'.urlencode($data_mail['attach'])), true));
	$email = new Mail();
	try {
		$email->setFrom($de, $data_mail['usuario']);
		$email->setSubject($asunto);
		$email->addTo($para, "");
	} catch (Exception $e) {
		//return $e;
		return 0;
	}
	//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
	$email->addContent(
		"text/html",
		$mensaje
	);
	//$adjunto = DOCS_UPLOAD . 'empresa_' . EMPRESA_ID . '/documentos/' . $adjunto;
	if (!empty($adjunto)) {
		if (file_exists($adjunto)) {
			$doc = file_get_contents($adjunto);
			//pre_die($doc);
			if ($fileType == 'pdf') {
				$email->addAttachment(
					base64_encode($doc),
					'application/pdf',
					'Documento_' . rand(11111, 99999) . '.pdf'
				);
			} else if ($fileType == 'csv') {
				$email->addAttachment(
					base64_encode($doc),
					mime_content_type($adjunto),
					'Documento_' . rand(11111, 99999) . '.csv'
				);
			} else if ($fileType == 'xlsx') {
				$email->addAttachment(
					base64_encode($doc),
					'application/excel',
					'Documento_' . rand(11111, 99999) . '.xlsx'
				);
			}
		}
	}
	// $API_KEY = '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';
	// $API_KEY = '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';

	$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
	$message_id = 0;
	$success = false;
	$status_code = 0;
	// pre_die($sendgrid);
	try {
		$response = $sendgrid->send($email);
		$status_code = $response->statusCode();
		// pre_die($response);
		// Verificar el código de respuesta HTTP
		if ($status_code === 202) {
			$success = true;
			$array_headers = $response->headers();
			// pre_die($array_headers);
			foreach ($array_headers as $header) {
				if (strpos($header, 'X-Message-Id') !== false) {
					$message_id = str_replace('X-Message-Id: ', '', $header);
				}
			}
		} else {
			error_log('El correo no pudo enviarse. Código de respuesta: ' . $status_code);
		}
	} catch (Exception $e) {
		// Manejo de excepciones
		error_log('Error al enviar el correo: ' . print_r(json_encode($e->getMessage()), true));
	}

	// Verificar si el envío fue exitoso o si hubo un error debido al tamaño del archivo
	if ($success) {
		// Envío exitoso, hacer lo que corresponda
		$rsp  = [
			'tipo' => true,
			'msg' => $message_id
		];
		return $rsp;
	} else {
		$rsp  = [
			'tipo' => false,
			'msg' => $status_code
		];
		return $rsp;
		// Error en el envío debido al tamaño del archivo, realizar las acciones necesarias
	}

	//error_log('que pasoMAIL'.print_r(json_encode($response), true));
}
