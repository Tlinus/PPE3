<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$project=$_POST['project'];
$cryptedId=$_POST['id'];

$facade=new SystemFacade($project);
$id=$facade->decrypt($cryptedId);
$file=$facade->getFileSystem()->getFile($id);
$displayer=new Displayer($file);

$displayer->display();

