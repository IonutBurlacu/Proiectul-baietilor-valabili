<?php 	

class View {
	public static function make($path, array $parameters = array()){
		/* Set all variables from parameters to be seen in view */
		foreach($parameters as $key => $parameter){
			${$key} = $parameter;
		}

		/* Include the view to be shown in browser */
		include(App::path('views') . "/" . $path . ".php");
	}

	public static function makeWithLayout($path, $layoutPath, array $parameters = array()){
		/* Set all variables from parameters to be seen in view */
		foreach($parameters as $key => $parameter){
			${$key} = $parameter;
		}
		if(isset($layoutPath['vars'])){
			foreach($layoutPath['vars'] as $key => $parameter){
				${$key} = $parameter;
			}	
		}

		include (App::path('views') . "/" . $layoutPath['header'] . ".php");
		include (App::path('views') . "/" . $path . ".php");
		include (App::path('views') . "/" . $layoutPath['footer'] . ".php");
	}

}

 ?>