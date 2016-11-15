<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';
$dirCrypted=$_GET['file'];
$project = $_GET['project'];

$facade=new SystemFacade($project);
$dir=$facade->decrypt($dirCrypted);
echo $facade->makeZipFromDir($dir);

