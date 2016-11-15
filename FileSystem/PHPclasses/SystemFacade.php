<?php

/**
 * Description of SystemFacade
 *
 * @author pascal
 */
class SystemFacade {
    
    private $_project;
    private $_currentFile;
    private $_crypter;
    private $_fileSystem;
    private $_db;
    private $_uploadPath="../uploads/";
    
    public function __construct($project) {
        $this->_project = $project;
        $this->_db = DataBaseFactory::connectDB();
        $this->_crypter = new Crypter();
        $this->_fileSystem = new SystemTree($project,$this->_db);
        $this->_currentFile = $this->_fileSystem->getRoot()->getID();
    }
    
    public function makeFileList(){
        $currentDirectory=$this->_fileSystem->getDirectory($this->_currentFile);
        $htmlCode = '<div id="'.$this->_crypter->Encode($this->_currentFile).'"class="currentFile"><img src="'.$currentDirectory->getImage().'"/>'.$currentDirectory->getVirtualName().' :</div>';
        $htmlCode.='<ul class="fileList">';
        if($this->_currentFile != $this->_fileSystem->getRoot()->getID()){
            $htmlCode.='<li id="'.$this->_crypter->Encode($this->_fileSystem->getDirParent($this->_currentFile)->getID()).'" class="SystemDirectory return"><img src="img/return.gif"/> ...</li>';
        }
        foreach($this->_fileSystem->getDirContent($this->_currentFile) as $object){
            $date = date_create($object->getDate());
            if(get_class($object)!='SystemDirectory'){
                $htmlCode .= '<li id="'.  $this->_crypter->Encode($object->getID()).'" class="'.get_class($object).' file"><img class="fileIcone" src="'.$object->getImage().'"/><div class="fileName listElement">'.$object->getVirtualName().'</div><div class="fileDate listElement" >'.date_format($date, 'd/m/y').'</div>'.'<img src="img/page_down.gif" class="dlImage" title="Download"/></li>';  
            }
            else{
                $htmlCode .= '<li id="'.  $this->_crypter->Encode($object->getID()).'" class="'.get_class($object).' "><img class="fileIcone" src="'.$object->getImage().'"/><div class="fileName listElement">'.$object->getVirtualName().'</div><div class="fileDate listElement" >'.date_format($date, 'd/m/y').'</div><img src="img/page_down.gif" class="dlImage" title="Download"/></li>';  

            }
        }
        $htmlCode.="</ul>";
        
        return $htmlCode;
    }
    public function makeMovableFileList(){
        $currentDirectory=$this->_fileSystem->getDirectory($this->_currentFile);
        $htmlCode = '<div id="'.$this->_crypter->Encode($this->_currentFile).'"class="currentFile"><img src="'.$currentDirectory->getImage().'"/>'.$currentDirectory->getVirtualName().' :</div>';
        $htmlCode.='<ul class="fileList">';
        if($this->_currentFile != $this->_fileSystem->getRoot()->getID()){
            $htmlCode.='<li id="'.$this->_crypter->Encode($this->_fileSystem->getDirParent($this->_currentFile)->getID()).'" class="SystemDirectory return"><img src="img/return.gif"/> ...</li>';
        }
        else{
            $htmlCode.='<li id="'.$this->_crypter->Encode($this->_fileSystem->getRoot()->getID()).'" class="SystemDirectory"><img src="'.$this->_fileSystem->getRoot()->getImage().'"/> Root</li>';
        }
        foreach($this->_fileSystem->getDirContent($this->_currentFile) as $object){
            if(get_class($object)=='SystemDirectory'){
                $htmlCode .= '<li id="'.  $this->_crypter->Encode($object->getID()).'" class="'.get_class($object).' "><img src="'.$object->getImage().'"/>'.$object->getVirtualName().'</li>';  
            }
        }
        $htmlCode.="</ul>";
        
        return $htmlCode;
    }
    
    public function setCurrentFile($fileID){
        $this->_currentFile=$fileID;
    }
    
    public function getFileSystem(){
        return $this->_fileSystem;
    }
    public function manageFileName($name,$parent){
        $file=$this->_fileSystem->checkName($name, $parent);
        if($file){
            $file->delete($this->_db);
        }
    }
    public function createObject($parent,$virtualName,$type,$mime = "",$source = "",$date = ""){
        switch($type){
            case 'SystemDirectory':
                $object= new SystemDirectory($parent, NULL, $virtualName, $this->_project,$date);
            break;
            case 'FileImage':
                $object= new FileImage($parent, NULL , $virtualName, $source, $this->_project,$type,$mime,$date);
            break;
            case 'FileCode':
                $object= new FileCode($parent, NULL , $virtualName, $source, $this->_project,$type,$mime,$date);
            break;
            case 'FileVideo':
                $object= new FileVideo($parent, NULL , $virtualName, $source, $this->_project,$type,$mime,$date);
            break;
            case 'FileAudio':
                $object= new FileAudio($parent, NULL , $virtualName, $source, $this->_project,$type,$mime,$date);
            break;
        }
        if($object->saveToDB($this->_db)){
            $this->_fileSystem->refresh();
            return true;
        }
        else{
            return false;
        }
    }
    public function deleteObject($type,$id){
        $DecryptedId = $this->_crypter->Decode($id);
        switch($type){
            case 'SystemDirectory':
                $this->_fileSystem->deleteDirectory($DecryptedId);
            break;
            default:
                $this->_fileSystem->deleteFile($DecryptedId);
            break;
        }
        $this->_fileSystem->refresh();
    }
    public function makeDownloadPage($cryptedID){
        
        $id=$this->_crypter->Decode(str_replace(" ","+",$cryptedID));
        $file=$this->_fileSystem->getFile($id);
        Downloader::setDownload($file->getSource(),$file->getSize(),$file->getVirtualName(),$file->getMime());
    }
    
    public function makeZipFromDir($id){

        $archiveName=$this->_uploadPath.md5(uniqid(rand(), true)).'.zip';       
        $zip = new ZipArchive();
        $zip->open($archiveName,ZIPARCHIVE::CREATE);
        $path='';
        $this->reformDirectory($id,$path,$zip);
        $zip->close();
        Downloader::setDownload($archiveName,filesize($archiveName),$this->_fileSystem->getDirectory($id)->getVirtualName().'.zip','application/zip');
        unlink($archiveName);
        
    }
    public function reformDirectory($id,$path,$zip){
        
        $path.=$this->_fileSystem->getDirectory($id)->getVirtualName().'/';
        $path2=$path;
        $content=$this->_fileSystem->getDirContent($id);
        $zip->addEmptyDir($path2);
        foreach($content as $object){
            if(get_class($object)=='SystemDirectory'){
                $this->reformDirectory($object->getID(),$path,$zip);           
            }
            else{
                $zip->addFile( $object->getSource(),$path2.$object->getVirtualName() );
            }
        }
    }
    public function refreshDirectoryDate($id){
        $directory=$this->_fileSystem->getDirectory($id);
        $parent=$directory->getParent();
        $directory->updateDate($this->_db);
        if($parent!=null){
            $this->refreshDirectoryDate($parent);
        }
    }
    public function decrypt($id){
        $result=$this->_crypter->Decode($id);
        return $result;
    }
}
