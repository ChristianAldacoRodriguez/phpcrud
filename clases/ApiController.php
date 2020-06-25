<?php
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/Response.php");

class ApiController{


	function Listen($dataContainer, $crudController){

		$method = isset($dataContainer['method']) ? $dataContainer['method'] : '';		
		
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


}


?>