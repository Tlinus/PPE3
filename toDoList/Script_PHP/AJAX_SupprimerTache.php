<?php
	session_start();
	require '../SQL/connectbdd.php';

	// on séléctionne les sous tache qui ont pour tache mere celle qu'on supprime
	$query = "SELECT * FROM tache where sous_tache_id = :id;";
	$select_query = $bdd->prepare($query);
	$select_query->bindValue(':id',		$_POST['id'],	PDO::PARAM_INT);
	$select_query->execute();
	$sousTaches = $select_query->fetchAll();
	$sousTachesNb = $select_query->rowCount();

	if($sousTachesNb > 0){
		foreach ($sousTaches as $key) {
			$query ="DELETE FROM tache WHERE id = :id ;";
			$delete_query = $bdd->prepare($query);
			$delete_query->bindValue(':id',		$key['id'],	PDO::PARAM_INT);
			$delete_query->execute();
		}
	}

	$query ="DELETE FROM tache WHERE id = :id ;";
	$delete_query = $bdd->prepare($query);
	$delete_query->bindValue(':id',		$_POST['id'],	PDO::PARAM_INT);
	$delete_query->execute();
	echo 'je suis appelé!';
?>