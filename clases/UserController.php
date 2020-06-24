<?php

include_once("CrudController.php");
include_once("Response.php");
include_once("CRUD.php");

class UserController extends CrudController{

	protected $primary_key_name = "id_user"; 
	protected $primary_key_value = 0;
	
	protected $table_name = "users";
	protected $table_fields = array("email", "password", "name");
	protected $create_fields = array("email" => "non_empty|str|required", "password" => "non_empty|str|required", "name" => "non_empty|str|required");
	protected $update_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $delete_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $read_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	
	
	public function Create($data){
		$filteredArray = $this->Filter($data, $this->create_fields);
		
		if(!$filteredArray['success']){
			Response::Respond(false, null, 'Missing values', 500);
		}
		
		$invalidArray = $this->Validate($filteredArray['data'], $this->create_fields);
		if( count($invalidArray) > 0){
			Response::Respond(false, null, 'Some data was invalid!', 500);
		}
		
		$primary_key_value = CRUD::InsertRow($this->table_name, $filteredArray['data']);
		$obj = CRUD::GetRow($this->table_name, $this->primary_key_name, $this->primary_key_value);
		
		Response::Respond(true, $obj, 'Insert success', 201);
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
		
	}
	
	
}

?>