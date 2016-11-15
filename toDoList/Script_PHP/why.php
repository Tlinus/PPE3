<?php
	session_start();
	$_SESSION['idProjet']=$_POST['idProjet'];
	header('Location: ../modifierUnProjet.php');