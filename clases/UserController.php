<?php

include_once("CrudController.php");
include_once("Response.php");

class UserController extends CrudController{

	protected $primary_key_name = "id_user"; 
	protected $primary_key_value = 0;
	
	protected $table_name = "users";
	protected $table_fields = array("email", "password", "name");
	protected $create_fields = array("email" => "", "password" => "", "name" => "");
	protected $update_fields = array("email" => "", "password" => "", "name" => "");
	protected $delete_fields = array("email" => "", "password" => "", "name" => "");
	
	
	public function Create($data){
		$filteredArray = $this->Filter($data, $this->create_fields);
		
		if(!$filteredArray['success']){
			
			$res = Response::CreateErrorTemplate(null);
			
			echo json_encode($res);
			return;
		}
		
		
		
	}
	
	public function Read($data){
		
	}
	
	public function Update($data){
		
	}
	
	public function Delete($data){
		
	}
	
	
}

?>