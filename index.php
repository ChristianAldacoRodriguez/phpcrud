<?php


include_once("clases/UserController.php");

$crud = new UserController();
$crud->Create($_GET);

?>