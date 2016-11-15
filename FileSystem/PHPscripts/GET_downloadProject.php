<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';

$project =$_GET['idProject'];
$facade = new SystemFacade($project);
$root = $facade->getFileSystem()->getRoot()->getID();
echo $facade->makeZipFromDir($root);