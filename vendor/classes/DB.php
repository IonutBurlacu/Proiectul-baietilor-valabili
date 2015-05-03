<?php 

class DB {
	private static $host = 'localhost';
	private static $dbname = 'adwise';
	private static $username = 'root';
	private static $password = '';

	private static $db;

	public static function boot(){
		self::$db = new PDO('mysql:host=localhost;dbname=adwise;charset=utf8', 'root', '');
	}

	public static function query($query){
		$stmt = self::$db->query($query);
		$result = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result[] = $row;
		}
		return $result;
		// var_dump($stmt);
		// return 1;
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

 ?>