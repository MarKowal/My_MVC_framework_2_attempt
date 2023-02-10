<?php

namespace Core;

class View{

    //funkcja wyświetla podesłane pliki
    public static function render($view, $args = []){

        extract($args, EXTR_SKIP);
        
        //podstawowy folder w którym są pliki view:
        $file = "../App/Views/$view"; 
        
        if(is_readable($file)){
            require $file;
        } else{
            echo "$file not found";
        }
    }
}


?>