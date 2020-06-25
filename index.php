<?php

include_once('./clases/ApiController.php');
include_once('./clases/UserController.php');

$api = new ApiController();
$api->Listen($_REQUEST, new UserController());


?>