<?php

class Input {

    public static function get($key){
        if(isset($_GET[$key])){
            return $_GET[$key];
        }
        else {
            return null;
        }
    }

    public static function post($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }
        else {
            return null;
        }
    }

    public static function all($method){
        if($method == "GET"){
            return $_GET;
        }
        else {
            return $_POST;
        }
    }

}

 ?>
