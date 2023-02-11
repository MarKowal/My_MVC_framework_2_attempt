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

    //funkcja renderująca ale wykorzystujaca Twig:
    public static function renderTemplate(string $template, array $args = []){
        static $twig = null;

        if($twig === null){
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}


?>