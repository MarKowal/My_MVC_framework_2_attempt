<?php

namespace Core;

class View{

    public static function render($view, $args = []){

        extract($args, EXTR_SKIP);
        
        $file = "../App/Views/$view"; 
        
        if(is_readable($file)){
            require $file;
        } else{
            throw new \Exception("$file not found");
        }
    }

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