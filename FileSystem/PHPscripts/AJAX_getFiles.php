<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';
if(isset($_POST['project'])&& isset($_POST['id'])){
    $idProject = $_POST['project'];
    $idFile = $_POST['id'];
    $Facade = new SystemFacade($idProject);
    $id=$Facade->decrypt($idFile);
    $Facade->setCurrentFile($id);
    echo $Facade->makeFileList();
}
else{
    echo 'No file selected';
}