<?php

/**
 * Description of DataBaseFactory
 *
 * @author pascal
 */
class DataBaseFactory {
    public static function connectDB(){
        try{
        $db = new PDO('mysql:host=localhost;dbname=filesystem', 'root', '');
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        return $db;
    }
}
