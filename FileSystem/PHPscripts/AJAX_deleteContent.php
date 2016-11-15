<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$type = $_POST['type'];
$id = $_POST['id'];
$project = $_POST['project'];

$facade=new SystemFacade($project);
$facade->deleteObject($type, $id);
echo $facade->makeFileList();