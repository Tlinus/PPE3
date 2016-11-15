<?php


/**
 * Description of File
 *
 * @author pascal
 */
abstract class File extends SystemObject{
    protected $_source;
    protected $_type;
    protected $_mime;
    public function __construct($path,$id,$virtualName,$source,$project,$type,$mime,$date){
        parent::__construct($path, $id, $virtualName,$project,$date);
        $this->_source=$source;
        $this->_mime=$mime;
        $this->_dbTable='file';
        $this->_img='img/page.gif';
        $this->_type=$type;
    }
    public function getSource(){
        
        return $this->_source;
    }
    public function getSize(){
        
        return filesize($this->_source);
    }
     public function delete(PDO $db){
        $query=$db->prepare('DELETE FROM '.$this->_dbTable.' WHERE id=:id');
        $result=$query->execute(array('id'=>$this->_id));
        if($result){
            if(unlink($this->_source)){
                    return true;
                }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    
    public function saveToDB(PDO $db){
        $query = $db->prepare('INSERT INTO '.$this->_dbTable.'(`id`, `virtualName`, `parentDirectory`, `src`, `project`,type,mime,date) VALUES (NULL,:name,:parent,:src,:project,:type,:mime,NOW())');
        $result = $query->execute(array('name'=>$this->_virtualName,'parent'=>$this->_parentPath,'project'=>$this->_project,'src'=>$this->_source,'type'=>$this->_type,'mime'=>$this->_mime));
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
    public function getImage() {
        return $this->_img;
    }
    public function getType(){
        return $this->_type;
    }
    public function getMime(){
        return $this->_mime;
    }
}
