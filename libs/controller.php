<?php

class Controller{
    
    function __construct(){
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'model/'.$model.'model.php';

        if(file_exists($url)){
            require_once $url;
            $modelName = $model.'Model';
            $this->model = new $modelName;
        }
    }

    function existPOST($params){
        foreach((array)$params as $param){
            if(!isset($_POST[$param])){
                return false;
            }
        }
        return true;
    }

    function getPOST($param){
        return $_POST[$param];
    }

    function emptyPOSTS($params){
        foreach((array)$params as $param){
            if(empty($_POST[$param])){
                return true;
            }
        }
        return false;
    }

    function redirect($route, $message){
        header('Location: '. constant('URL'). $route);
    }


}

?>