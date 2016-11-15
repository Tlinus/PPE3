<?php
	

// ---------------------------------------------------
if(isset($projetId) && is_numeric($projetId) && $projetId>0)
{
	// ---------------------
	// Récupération des champs dans la BD
	// ---------------------

	// ---------------------
	// Récupération des champs Titre, id et dead-line.
	// ---------------------
	$projet_fiche_query 		= "SELECT * FROM projet ".
								" WHERE id = :projetId;";
	
	$pdo_select 				= $bdd->prepare($projet_fiche_query);
	$pdo_select->bindValue		(':projetId', 		$projetId,		PDO::PARAM_INT);
	$pdo_select->execute();
	$projet_fiche_nombre 		= $pdo_select->rowCount();
	$projet_fiche_row			= $pdo_select->fetch();
  
  	$projet_id 					= intval($projet_fiche_row['id']);
  	$projet_titre				= $projet_fiche_row['titre'];
  	$projet_dead_line			= $projet_fiche_row['dead_line'];

  	// ---------------------
	// Récupération des champs Tache lié au projet séléctionné:
	// id, commentaire, intitulé et dead-line.
	// ---------------------
  

  }
