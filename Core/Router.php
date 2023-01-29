<?php

class Router {

    //routing table to tablica asocjacyjna:
    protected $routes = [];
    protected $params = [];

    //1. proste dodawanie route ze stałymi parametrami:
    public function add($route, $params = []){
        //funkcja uzupełnia routing table
        //1.usuwa z route ukośnik
        $reg_exp = '/\//';
        $replacement = '\\/';
        //$route = '{controller}/{action}';
        $route = preg_replace($reg_exp, $replacement, $route);
        //2.zamienia nawiasy {} na regexa
        $reg_exp = '/\{([a-z]+)}/';
        $replacement = '(?P<\1>[a-z-]+)';
        $route = preg_replace($reg_exp, $replacement, $route);
        //3.dodaje początek i koniec regexa zrobionego z routa
        $route = '/^'.$route.'$/i';
        //4.zapisuje routa-regexa w routing table
        $this->routes[$route] = $params; //params to controller i action
    }

    public function getRoutes(){
        //funkcja pobiera tablicę $routes
        return $this->routes;
    }

    public function match($url){
        //funkcja porównuje URL z routes w routing table
        //jeżeli URL pasuje, to zapisuje controller i action w zmiennej params
        // 1. proste matchowanie - porównanie dwóch stringów
        /*foreach ($this->routes as $route => $params){
            if($url == $route){
                $this->params = $params;
                return true;
            }
        }
        return false;
        */

        // 2. zaawansowane matchowanie - porównanie czy URL pasuje do REGEXa:
        //założenie: struktura URL jest stała, czyli controller/akcja
        //$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        
        foreach($this->routes as $route => $params){
            //if(preg_match($reg_exp, $url, $matches)){
            if(preg_match($route, $url, $matches)){
                //$params = [];
                foreach($matches as $key => $match){
                    //$key to controller, a $match to action
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getParams(){
        //funkcja pobiera tablicę $params
        return $this->params;
    }
}
