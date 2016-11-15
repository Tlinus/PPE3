<?php

$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';


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