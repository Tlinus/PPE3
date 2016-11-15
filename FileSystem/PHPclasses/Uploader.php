<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uploader
 *
 * @author pascal
 */
class Uploader {
    private $_imageExtensions = array('jpg','mpeg','jpeg','gif','png');
    private $_codeExtensions = array('php','txt','html','js','css','sql');
    private $_videoExtensions = array('mp4');
    private $_audioExtensions = array('mp3','ogg','wav');
    private $_maxFileSize = 100000000;
    private $_destinationFolder='../uploads/';
    private $_fileName;
    private $_fileType;
    private $_fileTmp;
    private $_fileSize;
    private $_fileError;
    // variables générées pour vérifier le type, encoder le nom et récupérer les erreurs
    private $_generatedName;
    private $_realType;
    private $_error = "";
    private $_uploadedSource;
    
    public function __construct( $fileName,$fileType,$fileTmp,$fileSize,$fileError) {
        $this->_fileName=$fileName;
        $this->_fileSize=$fileSize;
        $this->_fileType=$fileType;
        $this->_fileTmp=$fileTmp;
        $this->_fileError=$fileError;
        $this->_generatedName = $this->generateName().'.'.$this->getExtension();
    }
    public function uploadFile(){
        if($this->_fileError===UPLOAD_ERR_OK ){
            if($this->fileVerif()){
                if(move_uploaded_file($this->_fileTmp,$this->_destinationFolder.$this->_generatedName)){
                    $this->_uploadedSource=$this->_destinationFolder.$this->_generatedName;
                    return true;
                }
                else{
                    $this->_error=$this->_fileName.": Couldn't move file to directory.";
                    return false;
                }
            }
        }
        else{
            $this->_error=$this->_fileName.': Error happend during upload';
        }
    }
    public function generateName(){
        return md5(uniqid(rand(), true));
    }
    public function fileVerif(){
        if($this->verifName()){
            if($this->imageTypeVerif() || $this->codeTypeVerif() || $this->videoTypeVerif() || $this->audioTypeVerif()){
                if($this->_fileSize<=$this->_maxFileSize){
                    return true;
                }
                else{
                    $this->_error=$this->_fileName.": File is too heavy.";
                }
            }
            else{
                $this->_error=$this->_fileName.": Invalid file type.";
            }
        }
        else{
            $this->_error=  $this->_fileName.":File name contains invalids characters";
        }
        return false;
    }
    public function imageTypeVerif(){
        if(in_array(strtolower($this->getExtension()),$this->_imageExtensions)){
            foreach($this->_imageExtensions as $type){
                if(strstr($this->_fileType, $type)){
                    $this->_realType = 'FileImage';
                    return true;
                }
            }
        }
        return false;
    }
    public function codeTypeVerif(){
        if(in_array(strtolower($this->getExtension()),$this->_codeExtensions)){
            foreach($this->_codeExtensions as $type){
                if(strstr($this->_fileType, $type)|| strstr($this->_fileType, 'plain')){
                    $this->_realType = 'FileCode';
                    return true;
                }
            }
        }
        return false;
    }
    public function videoTypeVerif(){
        if(in_array(strtolower($this->getExtension()),$this->_videoExtensions)){
            foreach($this->_videoExtensions as $type){
                if(strstr($this->_fileType, $type)){
                    $this->_realType = 'FileVideo';
                    return true;
                }
            }
        }
        return false;
    }
    public function audioTypeVerif(){
        if(in_array(strtolower($this->getExtension()),$this->_audioExtensions)){

                    $this->_realType = 'FileAudio';
                    return true;

        }
        return false;
    }
    public function verifName(){
        return preg_match("/^[A-Za-z0-9._]+$/", $this->_fileName) ;
    }
    public function getExtension(){
        return $extension  = pathinfo($this->_fileName, PATHINFO_EXTENSION);
    }
    public function getRealType(){
        return $this->_realType;
    }
    public function getError(){
        return $this->_error;
    }
    public function getUploadedSource(){
        return $this->_uploadedSource;
    }
    public function getFileName(){
        return $this->_fileName;
    }
    function getFileType() {
        return $this->_fileType;
    }


}
