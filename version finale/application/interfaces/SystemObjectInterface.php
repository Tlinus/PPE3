<?php
/**
 *
 * @author pascal
 */
interface SystemObjectInterface {
    
    public function delete(PDO $db);
    public function moveTo($path,PDO $db);
    public function changeVirtualName($name,PDO $db);
    public function getParent();
    public function getID();
    public function getVirtualName();
    public function getImage();
    public function saveToDB(PDO $db);
    
}
