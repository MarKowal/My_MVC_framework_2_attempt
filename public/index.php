<?php

//FRONT CONTROLLER

echo "<h1>Hello my Friend!</h1>";

//echo 'Requested route = '.$_SERVER['QUERY_STRING'].'<br>'.'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['SERVER_NAME'].'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['DOCUMENT_ROOT'].'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['SCRIPT_NAME'].'<br>';

require '../Core/Router.php';
$router = new Router();
//echo get_class($router);  //zwraca nazwę klasy danego obiektu

$router->add