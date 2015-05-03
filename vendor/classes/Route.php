<?php 

class Route {

	private static $getRoutes = array();
	private static $postRoutes = array();

	public static function boot(){
		require_once(App::path('base') . '/routes.php');
		self::listen();
	}

	public static function get($url, $action){
		self::$getRoutes[$url] = $action;
	}

	public static function post($url, $action){
		self::$postRoutes[$url] = $action;
	}

	public static function listen(){

		$method = $_SERVER['REQUEST_METHOD'];
		$path = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url = parse_url($path, PHP_URL_PATH);
		self::call($url, $method);
	}

	public static function call($url, $method){
		switch($method){
			case 'GET':
				if(array_key_exists($url, self::$getRoutes)){
					$string = explode('@', self::$getRoutes[$url]);

		            $controller = $string[0];
		            $action = $string[1];

		            require_once(App::path('controllers') . "/" . $controller . '.php');

		            $controllerPath = explode('/', $controller);

		            $controllerName = end($controllerPath);
		            $controller = new $controllerName();
		            $controller->{$action}();
				}
				break;
			case 'POST':
				// var_dump($url);
				// return 1;
				if(array_key_exists($url, self::$postRoutes)){
					$string = explode('@', self::$postRoutes[$url]);

		            $controller = $string[0];
		            $action = $string[1];

		            require_once(App::path('controllers') . '/' . $controller . '.php');

		            $controllerPath = explode('/', $controller);

		            $controllerName = end($controllerPath);
		            $controller = new $controllerName();
		            $controller->{$action}();
				}
				break;
		}
	}




}

 ?>