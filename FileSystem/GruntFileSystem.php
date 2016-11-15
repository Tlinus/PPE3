<?php
//nom du fichier contenant les classes
$_FILE_NAME='PHPclasses/';

// contient le début du path
$_PATH_RELATIVE="";

for($i=0;$i<$_GRUNT_PATH;$i++){
    $_PATH_RELATIVE.='../';
}
$_PATH_RELATIVE.=$_FILE_NAME;

require_once $_PATH_RELATIVE.'SystemObjectInterface.php';
require_once $_PATH_RELATIVE.'SystemObject.php';
require_once $_PATH_RELATIVE.'File.php';
require_once $_PATH_RELATIVE.'SystemDirectory.php';
require_once $_PATH_RELATIVE.'DataBaseFactory.php';
require_once $_PATH_RELATIVE.'SystemTree.php';
require_once $_PATH_RELATIVE.'Crypter.php';
require_once $_PATH_RELATIVE.'SystemFacade.php';
require_once $_PATH_RELATIVE.'Uploader.php';
require_once $_PATH_RELATIVE.'FileCode.php';
require_once $_PATH_RELATIVE.'FileImage.php';
require_once $_PATH_RELATIVE.'FileVideo.php';
require_once $_PATH_RELATIVE.'FileAudio.php';
require_once $_PATH_RELATIVE.'Downloader.php';
require_once $_PATH_RELATIVE.'Displayer.php';