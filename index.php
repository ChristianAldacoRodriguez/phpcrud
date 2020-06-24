<?php


include_once("clases/UserController.php");

$crud = new UserController();
/*$crud->ReadList(array(
	"name"=>"juos"
));*/

//$crud->Update($_GET);
$crud->Delete($_GET);

?>