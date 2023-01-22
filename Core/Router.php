<?php

class Router {

    //routing table to tablica asocjacyjna:
    protected $routes = [];
    protected $params = [];

    public function add($route, $params){
        //funkcja uzupełnia routing table
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

        // 2. zaawansowane porównanie czy URL pasuje do REGEXa:
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        
        if(preg_match($reg_exp, $url, $matches)){
            $params = [];
            foreach($matches as $key => $match){
                //$key to controller, a $match to action
                if(is_string($key)){
                    $params[$key] = $match;
                }
            }
            $this->params = $params;
            return true;
        }
        return false;
    }

    public function getParams(){
        //funkcja pobiera tablicę $params
        return $this->params;
    }
}
