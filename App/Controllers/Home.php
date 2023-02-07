<?php

namespace App\Controllers;

class Home extends \Core\Controller{

    protected function before(){
        echo '<p>(before)</p>';
        return false;
    }

    protected function after(){
        echo '<p>(after)</p>';
    }
    
    public function indexAction(){
        echo "Hello from the index action in the Home controller!";
    }
}


?>