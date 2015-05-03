<?php 

class Model {

	protected $table;

	protected function find($id){
		$result = DB::query("SELECT * FROM " . self::$table . " WHERE id = '$id'");
		if(count($result) != 0){
			return $result[0];
		}
		else {
			return null;
		}
	}

}

 ?>