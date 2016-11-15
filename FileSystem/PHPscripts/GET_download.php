<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$id=$_GET['file'];
$project =$_GET['project'];

$facade=new SystemFacade($project);
$facade->makeDownloadPage($id);