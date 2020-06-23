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
		
		$invalidArray = array();
		
		foreach($post as $field => $value){			
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