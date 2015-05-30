<?php 

class Redirect {

	public static function to($url){
		header('Location: ' . App::$baseUrl . $url);
	}

}

 ?>