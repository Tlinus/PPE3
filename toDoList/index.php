<?php
session_start();

	if(isset($_SESSION['utilisateurId'])){
		header('Location:  mesProjets.php');
	}
	else{
		header('Location: connexion.php');
	}
?>