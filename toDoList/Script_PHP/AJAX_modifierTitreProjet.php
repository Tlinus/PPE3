<?php
	session_start();
	require '../SQL/connectbdd.php';
	$query ="UPDATE projet SET 
			titre = :titre
			WHERE id = :id ;";
	$delete_query = $bdd->prepare($query);
	$delete_query->bindValue(':titre',				$_POST['titre'],		PDO::PARAM_STR);
	$delete_query->bindValue(':id',					$_POST['id'],			PDO::PARAM_INT);
	$delete_query->execute();

?>