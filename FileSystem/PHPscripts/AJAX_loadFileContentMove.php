<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$idFile=$_POST['id'];
$idProject=$_POST['idProj'];

$facade=new SystemFacade($idProject);
$facade->switchFileCrypted($idFile);
echo $facade->makeMovableFileList();
