<?php

include_once('../clases/CRUD.php');
include_once('../clases/Response.php');


$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

//Token not necessary
switch ($method) {
	case 'CREATE_USER':
		
		$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
		$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
		$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';

		if(!empty($email) && !empty($password) && empty($name)){
			$data = array('name' => $name, 'email'=>$email, 'password'=>md5($password));
			$id = CRUD::InsertRow('users', $data);

			$data['id_user'] = $id;
			Response::RespondJSON(true, 'Success', $data, 201);	
		}

		
		break;
	
	default:
		Response::RespondJSON(false, "Method not found", null, 500);
		break;
}


?>