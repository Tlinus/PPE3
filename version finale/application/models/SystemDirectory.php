<?php

/**
 * Description of Repertory
 *
 * @author pascal
 */
class SystemDirectory extends SystemObject {
    public function __construct($path,$id,$virtualName,$project,$date){
        parent::__construct($path, $id, $virtualName,$project,$date);
        $this->_img='../assets/img/folder.gif';
        $this->_dbTable='directory';
    }
    public function saveToDB(PDO $db){
        $query = $db->prepare('INSERT INTO '.$this->_dbTable.'(`id`, `virtualName`, `parentDirectory`, `project`,date) VALUES (NULL,:name,:parent,:project,NOW())');
        $result = $query->execute(array('name'=>$this->_virtualName,'parent'=>$this->_parentPath,'project'=>$this->_project));
        return $result;
    }
    public function getImage() {
        return $this->_img;
    }
    public function updateDate(PDO $db){
        $query = $db->prepare('UPDATE '.$this->_dbTable.' SET date=NOW() WHERE id=:id');
        $result = $query->execute(array('id'=>$this->_id));
        return $result;
    }
}
