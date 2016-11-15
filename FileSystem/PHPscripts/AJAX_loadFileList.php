<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$idProject=$_POST['id'];
$facade=new SystemFacade($idProject);
$code=$facade->makeMovableFileList();
echo $code;
