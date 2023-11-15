<?php

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
		return 'Sin información';
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
	$data = $table->getWhere(['estado' => true, 'eliminado' => false, 'id' => $usuario_id, 'perfil_id' => 4])->getRowObject();
	if (!empty($data)) {
		return $data;
	} else {
		return 'Sin información';
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
