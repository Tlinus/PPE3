<?php
$_GRUNT_PATH=1;
require_once '../GruntFileSystem.php';
$crypter = new Crypter();

$source=$crypter->Decode($_POST['id']);
$destination=$crypter->Decode($_POST['direction']);
$type=$_POST['type'];
$db= DataBaseFactory::connectDb();

if($type=="file"){
    $query='UPDATE `file` SET `parentDirectory`=:parent WHERE id=:id';
}
else{
    $query='UPDATE `directory` SET `parentDirectory`=:parent WHERE id=:id';
}
$exec=$db->prepare($query);
$exec->bindValue('parent', $destination);
$exec->bindValue('id', $source);
$result=$exec->execute();
if($result){
    echo 'Moving Success';
}
else{
    echo 'Moving Failed';
}
