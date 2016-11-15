<?php


class UploadFile extends CI_Controller {

  public function UploadFile() {
  
    parent::__construct();
    require_once(APPPATH.'models/DatabaseFactory.php');
    require_once(APPPATH.'interfaces/SystemObjectInterface.php');
    require_once(APPPATH.'abstracts/SystemObject.php');
    require_once(APPPATH.'models/SystemDirectory.php');
    require_once(APPPATH.'abstracts/File.php');
    require_once(APPPATH.'models/Crypter.php');
    require_once(APPPATH.'models/Displayer.php');
    require_once(APPPATH.'models/Downloader.php');
    require_once(APPPATH.'models/FileAudio.php');
    require_once(APPPATH.'models/FileCode.php');
    require_once(APPPATH.'models/FileImage.php');
    require_once(APPPATH.'models/FileVideo.php');
    require_once(APPPATH.'models/SystemTree.php');
      require_once(APPPATH.'models/Uploader.php');
    require_once(APPPATH.'models/SystemFacade.php');
      $this->load->helper('url');
  }
    public function upload(){
        if(isset($_FILES)){
    $project=$_POST['project'];
    $parentDirCrypted=$_POST['parent'];
    $facade=new SystemFacade($project);
    $parent = $facade->decrypt($parentDirCrypted);
    
    for($i=0;$i<count($_FILES['file']['name']);$i++ )
    {
        $fileName=$_FILES['file']['name'][$i];
        $fileTmp=$_FILES['file']['tmp_name'][$i];
        $fileType=$_FILES['file']['type'][$i];
        $fileSize=$_FILES['file']['size'][$i];
        $fileError=$_FILES['file']['error'][$i];

        $uploader= new Uploader($fileName, $fileType, $fileTmp, $fileSize, $fileError);
        
        if($uploader->uploadFile()){
            $facade->manageFileName($fileName,$parent);
            if($facade->createObject($parent, $uploader->getFileName(), $uploader->getRealType(), $uploader->getFileType(),$uploader->getUploadedSource())){
                
                $facade->refreshDirectoryDate($parent);
            }
            else{
                echo "Couldn't save file to database.";
            }
        }
        else{
            echo $uploader->getError();
        }
    }
    
    
    echo $facade->makeFileList();
}
    }
    
}