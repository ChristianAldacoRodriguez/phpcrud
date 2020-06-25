<?php

include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/Response.php");
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/CRUD.php");

$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

if(!empty($email) && !empty($password)){
	$row = CRUD::GetRowExplicit('users', 'email="'.$email.'" and password="'.$password.'"');
	if($row != null){

	 	$tokenRow = CRUD::GetRow("tokens",'owner_id', $row['id_user']);
	 	if($tokenRow == null){
			$id = CRUD::InsertRow("tokens", array('owner_id' => $row['id_user'], 'token'=> md5(time()), 'type' => 'LOGIN'));
			$tokenRow = CRUD::GetRow("tokens",'owner_id', $id);
	 	}

	 	Response::Respond(true, $tokenRow, 'Token', 200);

	}else{
		Response::Respond(false, null, 'No user found', 500);	
	}
	
}else{
	Response::Respond(false, null, "Empty paramter", 500);	
}



?>