<?php

namespace Core;

class Router {

    //routing table to tablica asocjacyjna:
    protected $routes = []; //to wzory dla wklepanych w przeglądarkę URL
    protected $params = []; //params to controller i action

    //proste dodawanie routes do routing table:
    public function add($route, $params = []){
        //1.usuwanie z route ukośnika
        $reg_exp = '/\//';
        $replacement = '\\/';
        //$route = '{controller}/{action}';
        $route = preg_replace($reg_exp, $replacement, $route);
        
        //2.zamienia nawiasy {} na regexa
        $reg_exp = '/\{([a-z]+)}/';
        $replacement = '(?P<\1>[a-z-]+)';
        $route = preg_replace($reg_exp, $replacement, $route);
        
        //3.opcjonalnie dodaje id, czyli liczby w route
        $reg_exp = '/\{([a-z]+):([^\}]+)\}/';
        $replacement = '(?P<\1>\2)';
        $route = preg_replace($reg_exp, $replacement, $route);
        
        //4.dodaje początek i koniec regexa zrobionego z routa
        $route = '/^'.$route.'$/i';
        
        //5.zapisuje routa-regexa w routing table
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
        //założenie: struktura URL jest stała, czyli np {controller}/{akcja}
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

    //DISPATCH - rozdzielenie URL na Controller i Action
    //żeby dynamicznie stworzyć obiekt i uruchomić metodę:
    public function dispatch($url){
        if($this->match($url)){
            //wyciągnięcie z parametrów nazwy kontrolera:
            $controller = $this->params['controller'];
            //zamiana pierwszej litery na dużą literę:
            $controller = $this->convertToStudlyCaps($controller);
            //dodanie namespace:
            $controller = "App\Controllers\\$controller";

            if(class_exists($controller)){
                //dynamicznie tworzę obiekt klasy kontroler:
                $controller_object = new $controller();

                //wyciągnięcie z parametrów nazwy action:
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controller_object, $action])){
                    //wywołanie metody na obiekcie:
                    $controller_object->$action();
                } else{
                    echo "<br>Method $action (in controller $controller) not found.";
                }
            } else{
                echo "<br>Controller class $controller not found.";
            }
        } else{
            echo '<br>No route matched.';
        }
    }

    protected function convertToStudlyCaps($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string){
        return lcfirst($this->convertToStudlyCaps($string));
    }


}
