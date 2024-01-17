<?php

class View{
    
    function render($archivo, $data = []){
        $this->data = $data;
        require 'view/'.$archivo.'.php';
    }

}

?>