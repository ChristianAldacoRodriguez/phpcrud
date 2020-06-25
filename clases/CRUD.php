<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpcrud-master/clases/DB.php');

class CRUD{

	//Inserts a row in selected table
	public static function InsertRow($tablename, $arrayvalues ){
		$db = new DB();
		$campos = array();
		$values =  array();
		foreach ($arrayvalues as $key => $value) {
			$str = "`".$key."`";
			array_push($campos, $str);

			$val = "'".$value."'";
			array_push($values, $val);
		}
		$sql = "INSERT into `".$tablename."` (".implode(",", $campos).") VALUES (".implode(",", $values).")";
		//echo $sql;
		$result = $db->Query($sql);
		$id = $db->insertID;
		return $id;
		//echo $result;
	}

	//Update a row of selected table with only one where clausule
	public static function UpdateRow($tablename, $arrayvalues, $whereField, $idWhere){
		$db = new DB();
		$campos = array();
		foreach ($arrayvalues as $key => $value) {
			$str = "`".$key."`='".$value."'";
			array_push($campos, $str);
		}
		$sql = "UPDATE `".$tablename."` SET ".implode(",",$campos)." WHERE `".$whereField."`=".$idWhere;
		$result = $db->Query($sql);
		return $result;
	}

	///Update rows with explicit WHERE clausule
	public static function UpdateRowExplicit($tablename, $arrayvalues,$whereField){
		$db = new DB();
		$campos = array();
		foreach ($arrayvalues as $key => $value) {
			$str = "`".$key."`='".$value."'";
			array_push($campos, $str);
		}
		$sql = "UPDATE `".$tablename."` SET ".implode(",",$campos)." WHERE ".$whereField;
		$result = $db->Query($sql);
	}

	//Delete a row with simple WHERE clausule
	public static function DeleteRow($tablename, $whereField, $idWhere){
		$db = new DB();
		$sql = "DELETE from `".$tablename."` WHERE `".$whereField."`=".$idWhere;
		//echo $sql;
		$result = $db->Query($sql);
		return $result;
	}
	
	//Delete a row with simple WHERE clausule
	public static function DeleteRowExplicit($tablename, $whereField){
		$db = new DB();
		$sql = "DELETE from `".$tablename."` WHERE ".$whereField;
		$result = $db->Query($sql);
		return $result;
	}

	//Get one row with simple where condition
	public static function GetRow($tablename, $whereField, $idWhere){
		$db = new DB();
		$sql = "SELECT * from ".$tablename." WHERE `".$whereField."`=".$idWhere;
		$result = $db->Query($sql);

		$row = ($result) ? mysqli_fetch_assoc($result) : null;
		return $row;
	}

	//Get one row with explicit WHERE Condition
	public static function GetRowExplicit($tablename, $whereField){
		$db = new DB();
		$sql = "SELECT * from ".$tablename." WHERE ".$whereField;
		$result = $db->Query($sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	//List all rows with simple where condition
	public static function ListRows($tablename, $whereField, $idWhere){
		$db = new DB();
		$sql = "SELECT * from ".$tablename." WHERE `".$whereField."`=".$idWhere;
		$result = $db->Query($sql);
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
        		$rows[] = $row;
    	}
		
		return $rows;
	}

	//List all registers that matches with especific where condition
	public static function ListRowsExplicit($tablename, $whereField){
		$db = new DB();
		$sql = "SELECT * from ".$tablename." WHERE ".$whereField;
		$result = $db->Query($sql);
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
        		$rows[] = $row;
    	}
		
		return $rows;
	}

	public static function ListAllRows($tablename){
		$db = new DB();
		$sql = "SELECT * from ".$tablename;
		$result = $db->Query($sql);
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
        		$rows[] = $row;
    	}
		
		return $rows;
	}
	
	public static function ExecuteSQL($sql){
		$db = new DB();
		$result = $db->Query($sql);
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
        		$rows[] = $row;
    	}
		return $rows;
	}

	public static function DeleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			//throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}
	
	public static function Mime_content_type($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }

	
}



?>