<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemObject
 *
 * @author pascal
 */
abstract class SystemObject implements SystemObjectInterface {
    
    protected $_parentPath;
    protected $_id;
    protected $_virtualName;
    protected $_dbTable;
    protected $_img;
    protected $_project;
    protected $_date;
    
    public function __construct($path,$id,$virtualName,$project,$date){
        
        $this->_parentPath = $path;
        $this->_id = $id;
        $this->_virtualName = $virtualName;
        $this->_project=$project;
        $this->_date=$date;
    }
    public function delete(PDO $db){
        $query=$db->prepare('DELETE FROM '.$this->_dbTable.' WHERE id=:id');
        $result=$query->execute(array('id'=>$this->_id));
        return $result;
    }
    
    public function moveTo($path,PDO $db){
        $this->_parentPath = $path;  
        $query = $db->prepare('UPDATE '.$this->_dbTable.' SET parentDirectory = :path WHERE id=:id');
        $result = $query->execute(array('path'=>$path,'id'=>$this->_id));
        return $result;
    }
    
    public function changeVirtualName($name, PDO $db) {
        $this->_virtualName=$name;
        $query = $db->prepare('UPDATE '.$this->_dbTable.' SET virtualName=:name WHERE id=:id');
        $result = $query->execute(array('name'=>$this->_virtualName,'id'=>$this->_id));
        return $result;
    }

    public function getParent() {
        return $this->_parentPath;
    }
    public function getID(){
        return $this->_id;
    }
    public function getVirtualName(){
        return $this->_virtualName;
    }

    public function getDate(){
        return $this->_date;
    }
}
