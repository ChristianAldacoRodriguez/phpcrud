<?php

class Response{
	
	var $success = false;
	var $message = "";
	var $error = "";
	var $data = null;
	
	function __construct($_success, $_msg, $_error, $_data){
		$this->success = $_success;
		$this->message = $_msg;
		$this->error = $_error;
		$this->data = $_data;
	}
	
	public static function CreateSuccessTemplate($_data, $_message = "The query was successfull"){
		$res = new Response(true, $_message, "", $_data);
		return $res;
	}
	
	public static function CreateErrorTemplate($_data, $_message = "There was an error"){
		$res = new Response(false, $_message, "", $_data);
		return $res;
	}
	
	public static function PrintAndFinish($response, $headers = array('Content-type: application/json'), $responseCode = 200){
		
		if($headers != null){
			foreach($headers as $header){
				header($header);
			}
		}
		

		http_response_code($responseCode);
		
		echo json_encode($response);
		die();
	}
	
}

?>