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


$router->add('', ['controller' => 'Home', 'action'=>'index']);
//$router->add('posts', ['controller' => 'Posts', 'action'=>'index'] );
//$router->add('posts/new', ['controller' => 'Posts', 'action'=>'new'] );
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('products/{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

//wyświetlenie routing table:
echo '<pre>';
    echo 'ROUTES:<br>';
    var_dump($router->getRoutes());
echo '</pre>';

//sprawdzanie czy URL pasuje z jakimś routem:
$url = $_SERVER['QUERY_STRING'];
if($router->match($url)){
    echo '<pre>';    
    echo 'PARAMETERS:<br>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for this URL = ".$_SERVER['QUERY_STRING'];
}

/*$reg_exp = "/ab(C)de(F)/";
$replacement = '\1wz67 \2er89';
$string = 'abCdeF';
$result = preg_replace($reg_exp, $replacement, $string);
echo "<p>$string</p>";
echo "<p>$result</p>";
*/

/*
$reg_exp = "/\//";
$replacement = "\\/";
$string = "{controller}/{action}";
$result = preg_replace($reg_exp, $replacement, $string);
echo "<p>$string</p>";
echo "<p>$result</p>";
echo '---';

$reg_exp = '/\{([a-z]+)\}/';
$replacement = '(?P<\1>[a-z-]+)';
$result2 = preg_replace($reg_exp, $replacement, $result);
echo "<p>$result</p>";
echo "<p>$result2</p>";
echo '---';

$result3 = '/^'.$result2.'$/i';
echo "<p>$result3</p>";

echo '------------------';*/


/*$reg_exp = '/\//';
$replacement = '\\/';
//$route = '{controller}/{action}';
$route = '{controller}/{id:\d+}/{action}';
$route = preg_replace($reg_exp, $replacement, $route);

$reg_exp = '/\{([a-z]+)}/';
$replacement = '(?P<\1>[a-z-]+)';
$route = preg_replace($reg_exp, $replacement, $route);

$reg_exp = '/\{([a-z]+):([^\}]+)\}/';
$replacement = '(?P<\1>\2)';
$route = preg_replace($reg_exp, $replacement, $route);

$route = '/^'.$route.'$/i';
echo "<p>$route</p>";*/
?>