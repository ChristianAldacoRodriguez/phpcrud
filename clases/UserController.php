<?php

include_once("CrudController.php");
include_once("Response.php");
include_once("CRUD.php");

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
			$res = Response::CreateErrorTemplate(null, 'Missing values');
			Response::RespondJSON($res, 500);
		}
		
		$invalidArray = $this->Validate($filteredArray['data'], $this->create_fields);
		if( count($invalidArray) > 0){
			$res = Response::CreateErrorTemplate(null, 'Some data was invalid!');
			Response::RespondJSON($res, 500);
		}
		
		$primary_key_value = CRUD::InsertRow($this->table_name, $filteredArray['data']);
		$obj = CRUD::GetRow($this->table_name, $this->primary_key_name, $this->primary_key_value);
		$res = Response::CreateSuccessTemplate($obj, 'Insert success');
		
		Response::RespondJSON($res, 201);
		
		
	}
	
	public function Read($primary_value){
		//Get one based on primary key

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
	
	public function Update($data){
		
	}
	
	public function Delete($data){
		
	}
	
	
}

?>