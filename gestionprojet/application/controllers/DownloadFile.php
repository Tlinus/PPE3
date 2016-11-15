<?php


class DownloadFile extends CI_Controller {

  public function DownloadFile() {
  
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
    require_once(APPPATH.'models/SystemFacade.php');
  }
    public function download(){
        $id=$_GET['file'];
        $project =$_GET['project'];

        $facade=new SystemFacade($project);
        $facade->makeDownloadPage($id);
    }
    
}