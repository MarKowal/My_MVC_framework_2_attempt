<?php

class Router {

    //routing table:
    protected $routes = [];

    public function add($route, $params){
        //funkcja uzupełnia routing table
        $this->routes[$route] = $params; //params to controller i action
    }

    public function getRoutes(){
        return $this->routes;
    }
}