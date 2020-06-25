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
	
}

?>