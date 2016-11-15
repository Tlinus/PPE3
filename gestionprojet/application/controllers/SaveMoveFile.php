<?php
class SaveMoveFile extends CI_Controller {

  public function SaveMoveFile() {
  
    parent::__construct();
    require_once(APPPATH.'models/DatabaseFactory.php');
    require_once(APPPATH.'models/Crypter.php');

  }

  public function savingMoveFile()
  {
        $crypter = new Crypter();

        $source=$crypter->Decode($_POST['id']);
        $destination=$crypter->Decode($_POST['direction']);
        $type=$_POST['type'];
        $db= DataBaseFactory::connectDb();

        if($type=="file"){
            $query='UPDATE `file` SET `parentDirectory`=:parent WHERE id=:id';
        }
        else{
            $query='UPDATE `directory` SET `parentDirectory`=:parent WHERE id=:id';
        }
        $exec=$db->prepare($query);
        $exec->bindValue('parent', $destination);
        $exec->bindValue('id', $source);
        $result=$exec->execute();
        if($result){
            echo 'Moving Success';
        }
        else{
            echo 'Moving Failed';
        }
  }

}
