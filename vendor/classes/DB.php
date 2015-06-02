<?php 
ini_set("display_errors", 1);
class DB {

	public static $db;

	public static function boot(){
		self::$db = new PDO("mysql:host=localhost;dbname=adwise", "adwise", "adwise2015");
		self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function query($query, $type = "select"){
		$stmt = self::$db->query($query);
		$result = array();
		
		if($type == "insert" || $type == "update" || $type == "delete"){

		}
		else {
			if($stmt != null){
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
				}
			}
			return $result;
		}
	}

	public static function dbInstance(){
		return self::$db;
	}

}

 ?>