<?php

/**
 * Description of DataBaseFactory
 *
 * @author pascal
 */
class DataBaseFactory {
    public static function connectDB(){
        try{
        $db = new PDO('mysql:host=172.17.10.101;dbname=redon2', 'redon2', 'slam2016');
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        return $db;
    }
}
