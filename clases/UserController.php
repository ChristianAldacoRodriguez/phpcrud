<?php

include_once("CrudController.php");

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
		
		echo json_encode($filteredArray);
	}
	
	public function Read($data){
		
	}
	
	public function Update($data){
		
	}
	
	public function Delete($data){
		
	}
	
	
}

?>