<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$parentCrypted = $_POST['parent'];
$name = $_POST['name'];
$project = $_POST['project'];
$type="SystemDirectory";

$facade = new SystemFacade($project);
$parent = $facade->decrypt($parentCrypted);
$facade->createObject($parent,$name,$type);
$facade->setCurrentFile($parent);
echo $facade->makeFileList();
