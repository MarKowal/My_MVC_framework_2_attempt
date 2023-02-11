<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller{

    protected function before(){
        //echo '<p>(before)</p>';
        //jeżeli w before() wyjdzie false to reszta kodu nie odpala
        //return false;
    }

    protected function after(){
        //echo '<p>(after)</p>';
    }
    
    public function indexAction(){
        //echo "Hello from the index action in the Home controller!";
        /*
        View::render('Home/index.php', [
            'name' => 'Karol',
            'title' => 'the Third'
        ]);
        */
        View::renderTemplate('Home/index.html', [
            'name' => 'Peter',
            'title' => 'the Third']);
    }
}


?>