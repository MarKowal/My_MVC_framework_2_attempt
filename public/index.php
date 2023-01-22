<?php

//FRONT CONTROLLER

echo "<h1>Routing table</h1>";

//echo 'Requested route = '.$_SERVER['QUERY_STRING'].'<br>'.'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['SERVER_NAME'].'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['DOCUMENT_ROOT'].'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['SCRIPT_NAME'].'<br>';

require '../Core/Router.php';
$router = new Router();
//echo get_class($router);  //zwraca nazwę klasy danego obiektu

/*
$router->add('', ['controller' => 'Home', 'action'=>'index']);
$router->add('posts', ['controller' => 'Posts', 'action'=>'index'] );
$router->add('posts/new', ['controller' => 'Posts', 'action'=>'new'] );
*/

//wyświetlenie routing table:
/*echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';*/

//sprawdzanie czy URL pasuje z jakimś routem:
$url = $_SERVER['QUERY_STRING'];
if($router->match($url)){
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for this URL = ".$_SERVER['QUERY_STRING'];
}