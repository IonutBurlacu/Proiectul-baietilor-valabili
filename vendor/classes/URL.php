<?php 

class URL {

	public static function to($url){
		echo App::$baseUrl . $url;
	}

	public static function getTo($url){
		return App::$baseUrl . $url;
	}

}

 ?>