<?php 

class App {

	private static $paths;

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
		/* Require all vendor classes */
		foreach (glob("vendor/classes/*.php") as $filename){
		    include $filename;
		}
		/* Set all paths */
		self::set();
		/* Initialize DB */
		DB::boot();
		/* Initialize router */
		Route::boot();
	}

}

 ?>