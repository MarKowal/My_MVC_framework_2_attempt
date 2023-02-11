<?php


//echo "<h1>FRONT CONTROLLER</h1>";

//echo 'Requested route = '.$_SERVER['QUERY_STRING'].'<br>'.'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['SERVER_NAME'].'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['DOCUMENT_ROOT'].'<br>';
//echo 'Other things from $_SERVER = '.$_SERVER['SCRIPT_NAME'].'<br>';

//poniższe require jest niepotrzebne bo mam Autoloader dla klas
//require '../Core/Router.php';
//require '../App/Controllers/Posts.php';

//require_once dirname(__DIR__).'/vendor/autoload.php';

//załadowanie Autoloadera z Composer:
require '../vendor/autoload.php';

/*
//AUTOLOADER dla klas - został zastąpiony przez Autoloader Composera w pliku composer.json:
spl_autoload_register(function ($class){
    //wyszukuję główny folder "parent directory"
    $root = dirname(__DIR__);
    //przerabiam namespace który przychodzi z dispatch()
    $file = $root.'/'.str_replace('\\', '/', $class).'.php';
    //jeżeli można odczytać powyższą ścieżkę do pliku to robie rquire
    if(is_readable($file)){
        require $root.'/'.str_replace('\\', '/', $class).'.php';
    }

});
*/

$router = new Core\Router();
//echo get_class($router);  //zwraca nazwę klasy danego obiektu


$router->add('', ['controller' => 'Home', 'action'=>'index']);
//$router->add('posts', ['controller' => 'Posts', 'action'=>'index'] );
//$router->add('posts/new', ['controller' => 'Posts', 'action'=>'new'] );
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
//$router->add('products/{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
/*
//wyświetlenie routing table:
echo "<h1>Routing table</h1>";
echo '<pre>';
    echo 'ROUTES:<br>';
    var_dump($router->getRoutes());
echo '</pre>';
*/

/*
//wyświetlenie i sprawdzanie czy URL pasuje z jakimś routem:
$url = $_SERVER['QUERY_STRING'];
echo 'URL czyli $_SERVER["QUERY_STRING"]  =  '.$url.'<br>';
if($router->match($url)){
    echo '<pre>';    
    echo '<br>PARAMETERS on router:<br>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for this URL = ".$_SERVER['QUERY_STRING'];
}
*/

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


/*
//ĆWICZENIE DYNAMICZNEGO TWORZENIA KLAS I WYWOŁYWANIA METOD:
class Post{
    public function print_message($name){
        echo "<br>this is ".$name." from class Post - DYNAMICALLY!<br>";
    }
}
$class_name = "Post";
$method_name = "print_message";
if(class_exists($class_name)){
    $post = new $class_name();
    if(is_callable([$post, $method_name])){
        call_user_func_array([$post, $method_name], ["Marek"]);
    } else {
        echo "There is no such method";
    }
} else {
    echo "There is no such class";
}
//$post = new Post();
//$post->print_message();
*/



$router->dispatch($_SERVER['QUERY_STRING']);


/*
class Animal{
    private function bark(){
        echo '<br>Bark!<br>';
    }
}

$animal = new Animal();
//$animal->bark();

class Dog extends Animal{}

$dog = new Dog();
$dog->bark();
*/

?>