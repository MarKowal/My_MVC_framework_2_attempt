<?php

namespace App\Controllers;

class Posts extends \Core\Controller{

    public function index(){
        echo "<p>Hello from the index action in the Posts controller!</p>";
        //echo '<p>Query string parameters: <pre>'.htmlspecialchars(print_r($_GET, true)).'</pre></p>';
    }

    public function addNew(){
        echo "Hello from the addNew action in the Posts controller!";
    }

    public function edit(){
        echo "Hello from the edit action in the Posts controller!";
        echo '<p>Route parameters from the Posts controller: <pre>'.htmlspecialchars(print_r($this->route_params, true)).'</pre></p>';
    }   
}