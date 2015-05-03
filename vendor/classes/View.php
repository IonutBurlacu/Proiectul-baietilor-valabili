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

		/* Include the content */
		$content = file_get_contents(App::path('views') . "/" . $path . ".php");
		
		/* Include the layout */
		include (App::path('views') . "/" . $layoutPath . ".php");


	}

}

 ?>