<?php 

class App {

	private static $paths;
	public static $baseUrl = "http://bucium.mobiletouch.ro:6010";

	public static function path($path){
		return self::$paths[$path];
	}

	public static function set(){
		$basePath = realpath(dirname(__FILE__) . '/..');
		self::$paths = array(
			"base" => $basePath,
			"controllers" => $basePath . '/app/controllers',
			"views" => $basePath . '/app/views',
		);
	}

	public static function boot(){
		// error_reporting(0);
		/* Require all vendor classes */
		foreach (glob("vendor/classes/*.php") as $filename){
		    include $filename;
		}
		/* Start session */
		session_start();
		/* Set all paths */
		self::set();
		/* Initialize DB */
		DB::boot();
		/* Initialize router */
		Route::boot();
	}

}

 ?>