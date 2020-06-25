<?php

include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/Response.php");
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/CRUD.php");

class CrudController{
	
	protected $primary_key_name = "id"; 
	protected $primary_key_value = 0;
	
	protected $table_name = "";
	protected $table_fields = array();
	protected $create_fields = array();
	protected $update_fields = array();
	protected $delete_fields = array();
	
	public function Create($data){
		$filteredArray = $this->Filter($data, $this->create_fields);
		
		if(!$filteredArray['success']){
			Response::Respond(false, null, 'Missing values', 500);
		}
		
		$invalidArray = $this->Validate($filteredArray['data'], $this->create_fields);
		if( count($invalidArray) > 0){
			Response::Respond(false, $invalidArray, 'Some data was invalid!', 500);
		}
		
		$primary_key_value = CRUD::InsertRow($this->table_name, $filteredArray['data']);
		$obj = CRUD::GetRow($this->table_name, $this->primary_key_name, $this->primary_key_value);
		
		Response::Respond(true, $obj, 'Insert success', 201);
	}
	
	public function Read($data){
		//Get one based on primary key
		$filteredArray = $this->Filter($data, array( $this->primary_key_name => 'required'));
		
		$invalidArray = $this->Validate($filteredArray['data'], array( $this->primary_key_name => 'required'));
		if( count($invalidArray) > 0){
			Response::Respond(false, null, 'Primary key data was invalid!', 500);
		}


		$primary_value = $filteredArray['data'][$this->primary_key_name];


		$dbres = CRUD::GetRow($this->table_name, $this->primary_key_name, $primary_value);
		if($dbres != null){
			$res = Response::CreateSuccessTemplate($dbres, 'Success');
			Response::RespondJSON($res, 200);
		}
		else{
			$res = Response::CreateErrorTemplate(null, 'Not found');
			Response::RespondJSON($res, 500);
		}
	}

	public function ReadList($data){

		//data = secundary values to filter
		$filteredArray = $this->Filter($data, $this->read_fields);
		
		$invalidArray = $this->Validate($filteredArray['data'], $this->read_fields);
		if( count($invalidArray) > 0){
			Response::Respond(false, null, 'Some data was invalid!', 500);
		}

		$where = "";
		$and = "";
		foreach ($filteredArray['data'] as $key => $value) {
			$where .= "$and $key=". ( (is_int($value))?$vaue:"\"$value\" " );
			$and = "AND";
		}

		$result = CRUD::ListRowsExplicit($this->table_name, $where);
		Response::Respond(true, $result, 'List', 200);
	}
	
	public function Update($data){
		
		$this->primary_key_value = isset($data[$this->primary_key_name]) ? $data[$this->primary_key_name]: 0;
		

		if($this->primary_key_value <= 0){
			Response::Respond(false, null, 'No id!', 500);
		}

		$filteredArray = $this->Filter($data, $this->update_fields);
		
		$invalidArray = $this->Validate($filteredArray['data'], $this->update_fields);
		if( count($invalidArray) > 0){
			Response::Respond(false, null, 'Some data was invalid!', 500);
		}
		
		$res = CRUD::UpdateRow($this->table_name, $filteredArray['data'], $this->primary_key_name, $this->primary_key_value);
		Response::Respond(true, $res, 'Update success', 200);
	}
	
	public function Delete($data){
		$this->primary_key_value = isset($data[$this->primary_key_name]) ? $data[$this->primary_key_name]: 0;

		if($this->primary_key_value <= 0){
			Response::Respond(false, null, 'No id!', 500);
		}
		
		$res = CRUD::DeleteRow($this->table_name, $this->primary_key_name, $this->primary_key_value);
		Response::Respond(true, $res, 'Delete success', 500);
	
	}
	
	
	protected function Filter($post, $compareArray){
		
		$response = array(	'success' => true,
							'data' => array(),
							'message' => "");
		
		foreach($compareArray as $field => $val){
			
			if(!array_key_exists($field, $post)){
				$response['success'] = false;
				//$response['data'] = null;
				$response['message'] .= "Missing $field, ";
				//break;
			}else{
				$response['data'][$field] = $post[$field];
			}
		}
		
		return $response;
		
	}
	
	protected function Validate($post, $validationArray){
		
		//Options
		//non_empty = String empty or null value
		//str = Value need to be string
		//int = Value need to be int
		//non_zero = Value cannot be 0
		//non_negative = Value cannot be negative
		
		$invalidArray = array();
		
		foreach($post as $field => $value){

			/*if(strpos($validationArray[$field], "required") === false){
				continue;
			}*/

			$validationFields = explode('|',$validationArray[$field]);
			
			foreach($validationFields as $code){
			
				$isValid = false;
				$message = "There is something incorrect.";
			
				switch($code){
					
					case 'non_empty':
						
						$isValid = !empty($value);
						$message = "Value is empty!";
						
					break;
					case 'str':
					
						$isValid = is_string($value);
						$message = "Value is not string";
					
					break;
					case 'int':
						$isValid = is_int($value);
						$message = "Value is not int";
					break;
					case 'non_zero':
						$isValid = is_int($value) ? $value != 0 : $value != "0";
						$message = "Value is zero!";
					break;

				}
				
				if(!$isValid){
					//$invalidArray[$field][$code] = $message;
					$invalidArray[$field] = $message;
				}
				
			
			}
			
			
		}
		
		return $invalidArray;
				
		
	}
	
	
	protected function Respond(){
		
		echo "RESPOND!";
		die();
		
	}
	
}


?>