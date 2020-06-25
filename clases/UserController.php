<?php

include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/CrudController.php");
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/Response.php");
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/CRUD.php");

class UserController extends CrudController{

	protected $primary_key_name = "id_user"; 
	protected $primary_key_value = 0;
	
	protected $table_name = "users";
	protected $table_fields = array("email", "password", "name");
	protected $create_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $update_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $delete_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	protected $read_fields = array("email" => "non_empty|str", "password" => "non_empty|str", "name" => "non_empty|str");
	
}

?>