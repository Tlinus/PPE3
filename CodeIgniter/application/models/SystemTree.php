<?php

/**
 * Description of SystemTree
 *
 * @author pascal
 */
class SystemTree {
    
    private $_objectList=array();
    private $_db;
    private $_project;
    private $_root;
    
    public function __construct($projectId,$db){
        $this->_project=$projectId;
        $this->_db=$db;
        $this->getProjectDirectory();
        $this->getProjectFiles();
        $this->_root=$this->getSystemRoot();
    }
    public function getRoot(){
        return $this->_root;
    }
    public function getProjectFiles(){
        $query = $this->_db->prepare('SELECT * FROM file WHERE project=:id ORDER BY type,virtualName ASC');
        $result=$query->execute(array('id'=> $this->_project));
        if($result){
            while($data = $query->fetch()){
                switch($data['type']){
                    case 'FileImage':
                        $this->addFileSystemObject(new FileImage($data['parentDirectory'], $data['id'], $data['virtualName'], $data['src'],$this->_project,$data['type'],$data['mime'],$data['date']));
                    break;
                    case 'FileCode':
                        $this->addFileSystemObject(new FileCode($data['parentDirectory'], $data['id'], $data['virtualName'], $data['src'],$this->_project,$data['type'],$data['mime'],$data['date']));
                    break;
                    case 'FileVideo':
                        $this->addFileSystemObject(new FileVideo($data['parentDirectory'], $data['id'], $data['virtualName'], $data['src'],$this->_project,$data['type'],$data['mime'],$data['date']));
                    break;
                    case 'FileAudio':
                        $this->addFileSystemObject(new FileAudio($data['parentDirectory'], $data['id'], $data['virtualName'], $data['src'],$this->_project,$data['type'],$data['mime'],$data['date']));
                    break;
                }
            }
        }
        else{
            echo 'ERROR';
        }
    }
    public function getProjectDirectory(){
        $query = $this->_db->prepare('SELECT * FROM directory  WHERE project=:id ORDER BY virtualName DESC');
        $result=$query->execute(array('id'=> $this->_project));
        if($result){
            while($data = $query->fetch()){
                $this->addFileSystemObject(new SystemDirectory($data['parentDirectory'], $data['id'], $data['virtualName'],$this->_project,$data['date']));
            }
        }
        else{
            echo 'ERROR';
        }
    }
    public function addFileSystemObject(SystemObjectInterface $file){
        $this->_objectList[]=$file;
    }

    public function getDirContent($id){
        $result=array();
        foreach($this->_objectList as $object){
            if($object->getParent()== $id){
                $result[]=$object;
            }
        }
        return $result;
    }
    public function parseDirSon($fileID,$fileList){
        foreach($this->_objectList as $object){
            if($object->getParent() == $fileID && get_class($object) != 'SystemDirectory'){
                $fileList[]=$object;
            }
            if($object->getParent() == $fileID && get_class($object) == 'SystemDirectory'){
                $fileList[]=$object;
                $fileContent=$this->parseDirSon($object->getID(),$fileList);
                foreach( $fileContent as $objectFound){
                    $fileList[] = $objectFound;
                }
            }
        }
        return $fileList;
    }
    public function deleteDirectory($fileID){
        $toDeleteList=array();
        $toDeleteList=$this->parseDirSon($fileID, $toDeleteList);
        $toDeleteList[]=$this->getDirectory($fileID);
        foreach($toDeleteList as $object){
            $object->delete($this->_db);
        }
    }
    public function deleteFile($fileID){
        foreach($this->_objectList as $object){
            if($object->getID() == $fileID && get_class($object)!= 'SystemDirectory'){
                $object->delete($this->_db);
            }
        }
    }
    public function getSystemRoot(){
        foreach($this->_objectList as $object){
            if($object->getParent()== null){
                return $object;
            }
        }
         
    }
    public function refresh(){
        $this->_objectList=array();
        $this->getProjectDirectory();
        $this->getProjectFiles();
    }
    public function getDirParent($id){
        foreach($this->_objectList as $object){
            if($object->getID() == $id && get_class($object) == 'SystemDirectory'){
                return $this->getDirectory($object->getParent());
            }
        }
    }
    public function getDirectory($id){
        foreach($this->_objectList as $object){
            if($object->getID() == $id && get_class($object) == "SystemDirectory"){
                return $object;
            }
        }
    }
    public function getFile($id){
        foreach($this->_objectList as $object){
            if($object->getID() == $id && get_class($object) != "SystemDirectory"){
                return $object;
            }
        }
    }
    public function checkName($name,$parent){
        $parentContent=$this->getDirContent($parent);
        foreach($parentContent as $content){
            if(strtolower($content->getVirtualName())==strtolower($name)){
                return $content;
            }
        }
        return 0;
    }

}
