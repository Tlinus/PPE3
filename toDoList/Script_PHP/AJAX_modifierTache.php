<?php
	session_start();
	require '../SQL/connectbdd.php';
	$query ="UPDATE tache SET 
			commentaire= :commentaire, intitule= :intitule, dead_line= :dead_line
			WHERE id = :id ;";
	$delete_query = $bdd->prepare($query);
	$delete_query->bindValue(':commentaire',		$_POST['commentaire'],	PDO::PARAM_STR);
	$delete_query->bindValue(':intitule',			$_POST['intitule'],		PDO::PARAM_STR);
	$delete_query->bindValue(':dead_line',			$_POST['dead_line'],			PDO::PARAM_STR);
	$delete_query->bindValue(':id',					$_POST['id'],			PDO::PARAM_INT);
	$delete_query->execute();
	echo 'je suis appelé!';
?>