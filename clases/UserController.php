<?php

include_once("CrudController.php");
include_once("Response.php");

class UserController extends CrudController{

	protected $primary_key_name = "id_user"; 
	protected $primary_key_value = 0;
	
	protected $table_name = "users";
	protected $table_fields = array("email", "password", "name");
	protected $create_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $update_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $delete_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	
	
	public function Create($data){
		$filteredArray = $this->Filter($data, $this->create_fields);
		
		if(!$filteredArray['success']){
			$res = Response::CreateErrorTemplate(null);
			Response::PrintAndFinish($res, null, 500);
		}
		
		$invalidArray = $this->Validate($filteredArray['data'], $this->create_fields);
		if( count($invalidArray) > 0){
			$res = Response::CreateErrorTemplate(null);
			Response::PrintAndFinish($res, null, 500);
		}
		
		echo "All fine";
		
	}
	
	public function Read($data){
		
	}
	
	public function Update($data){
		
	}
	
	public function Delete($data){
		
	}
	
	
}

?>