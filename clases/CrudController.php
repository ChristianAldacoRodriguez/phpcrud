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
	
}


?>