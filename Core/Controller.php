<?php

namespace Core;

abstract class Controller{

    protected $route_params = [];
    //teraz każdy kontroler będzie potrzebował parametrów z routa żeby powstać
    public function __construct($route_params){
        $this->route_params = $route_params;
    }

    //FILTER ACTION - before() and after():
    public function __call($name, $args){
        //dodaję końcówkę Action do metody, żeby mogła być dopasowana
        $method = $name.'Action';

        if(method_exists($this, $method)){
            if($this->before() !== false){
                //funkcja uruchamia prawdziwą metodę z kontrolera:
                call_user_func_array([$this, $method], $args);
                $this->after();
            } 
        } else{
            //echo "Method $method not found in controller ".get_class($this);
            throw new \Exception("Method $method not found in controller ".get_class($this));
        }
    }

    protected function before(){}
    protected function after(){}

}