<?php
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/Response.php");
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/CRUD.php");

class ApiController{


	function Listen($dataContainer, $crudController, $accessNeededArray = array('create', 'read', 'list', 'update', 'delete')){

		$method = isset($dataContainer['method']) ? $dataContainer['method'] : '';
		$needToken = in_array($method, $accessNeededArray);
		if($needToken){

			$token = isset($dataContainer['token']) ? $dataContainer['token'] : "";
			$tokenObject = $this->CheckToken($token);
		}
		
		switch ($method) {
			case 'create':
				$crudController->Create($dataContainer);
				break;
			case 'read':
				$crudController->Read($dataContainer);
				break;
			case 'list':
				$crudController->ReadList($dataContainer);
				break;
			case 'update':
				$crudController->Update($dataContainer);
				break;
			case 'delete':
				$crudController->Delete($dataContainer);
				break;
			
			default:
				Response::Respond(false, null, 'Method not found!', 500);
				break;
		}

	}

	function CheckToken($token){

		$res = CRUD::GetRow('tokens', 'token', '"'.$token.'"');
		if($res != null){
			return $res;
		}else{
			Response::Respond(false, null, 'You need access to handle this method!');
		}

	}


}


?>