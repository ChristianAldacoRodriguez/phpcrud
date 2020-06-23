<?php

class DB{

	var $bd="panama";
	var $host="localhost";
	var $user="root";
	var $password ="";

	var $link;
	var $insertID = 0;

	function Connect(){
		$this->link = mysqli_connect($this->host,$this->user,$this->password,$this->bd);
	}

	function Query($sql){
		$this->Connect();
		$resultado = mysqli_query($this->link, $sql);
		$this->insertID = mysqli_insert_id($this->link);
		mysqli_close($this->link);
		return $resultado;
	}

}

?>