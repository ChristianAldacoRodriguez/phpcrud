<?php


include_once("clases/UserController.php");

$crud = new UserController();
$crud->ReadList(array(
	"password"=>"1234"
));

//$crud->Update($_GET);
//$crud->Delete($_GET);

?>