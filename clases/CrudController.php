<?php

class CrudController{
	
	protected $primary_key_name = "id"; 
	protected $primary_key_value = 0;
	
	protected $table_name = "";
	protected $table_fields = array();
	protected $create_fields = array();
	protected $update_fields = array();
	protected $delete_fields = array();
	
	public function Create($data){
		
	}
	
	public function Read($data){
		
	}
	
	public function Update($data){
		
	}
	
	public function Delete($data){
		
	}
	
	protected function Filter($post, $compareArray){
		
		$response = array(	'success' => true,
							'data' => array(),
							'message' => "");
		
		foreach($compareArray as $field => $val){
			
			if(!array_key_exists($field, $post)){
				$response['success'] = false;
				$response['data'] = null;
				$response['message'] = "$field not found!";
				break;
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
		
		$responseArray = array();
		
		foreach($post as $field => $value){			
			$validationFields = explode('|',$validationArray[$field]);
			
			$isValid = false;
			$message = "There is something incorrect.";
			foreach($validationFields as $code){
			
				switch($code){
					
					case 'non_empty':
						
						$isValid = !empty($value);
						
					break;
					case 'str':
					
						$isValid = is_string($value);
					
					break;
					case 'int':
						$isValid = is_int($value);
					break;
					case 'non_zero':
						$isValid = is_int($value) ? $value != 0 : $value != "0";
					break;
					
				}
				
				$responseArray[$field][$code] = $isValid;
			
			}
			
			
		}
		
		Response::PrintAndFinish($responseArray);
				
		
	}
	
	
	protected function Respond(){
		
		echo "RESPOND!";
		die();
		
	}
	
}


?>