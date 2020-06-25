<?php


include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/ApiController.php");
include_once($_SERVER['DOCUMENT_ROOT']."/phpcrud-master/clases/UserController.php");

$api = new ApiController();
$api->Listen($_REQUEST, new UserController());


?>