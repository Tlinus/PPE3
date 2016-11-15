<?php
session_start();

unset($_SESSION['utilisateurId']);
unset($_SESSION['isAdmin']);
unset($_SESSION['mail']);
$_SESSION = array();
session_destroy();
header('location: index.php');

?>