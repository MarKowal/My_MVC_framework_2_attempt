<?php

namespace Core;

use PDO;

abstract class Model{

    protected static function getDB(){

        static $db = null;

        if($db === null){

            $host = 'localhost';
            $dbname = 'mvc';
            $username = 'root';
            $password = '';

            try{
                $db = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
                //$stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');
                //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $db;

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

}

?>