<?php
function affiche_taches_only($projetId, $bdd){
	$tache_query				= "SELECT * FROM tache 
								   WHERE id_projet = :projet 
								   AND sous_tache_id = 0;";
	$pdo_select					= $bdd->prepare($tache_query);
	$pdo_select->bindValue		(':projet', 		$projetId, 	 PDO::PARAM_INT);
	$pdo_select->execute();
	$taches_principal			= $pdo_select->fetchAll();

	foreach ($taches_principal as $key) {
?>	<div class="tache">
		<div class="sousTacheDisplayer hidden">
			<label for="tache_titre">		<?php echo $key['intitule']; 	?> </label>
			<i class="dead_line_tache" >	<?php echo $key['dead_line']; 	?> </i>
			<p class="commentaire_tache">	<?php echo $key['commentaire']; ?> </p>
		</div>
<?php 	$tache_mere_id = $key['id'];

		$sous_tache_query				= " SELECT * FROM tache 
		  									WHERE sous_tache_id = :idtache ;";
		  	$pdo_select					= $bdd->prepare($sous_tache_query); 
		  	$pdo_select->bindValue		(':idtache', 		$tache_mere_id, PDO::PARAM_INT);
		  	$pdo_select->execute();
		  	$sous_taches				= $pdo_select->fetchAll();

		foreach ($sous_taches as $ky ) {
?> 		<div class="sous_tache" style="display: none;"> 
			<label for="titre_sous_tache" >			<?php echo $ky['intitule']; ?>		</label>
			<i class="dead_line_sous_tache"> 		<?php echo $ky['dead_line']; ?>		</i>
			<p class="commentaire_sous_tache"> 		<?php echo $ky['commentaire']; ?>	</p>
		</div>
<?php	} ?>	
	</div>
<?php 
	}	
}

function affiche_taches($projetId, $bdd){
	$tache_query				= "SELECT * FROM tache 
								   WHERE id_projet = :projet 
								   AND sous_tache_id = 0;";
	$pdo_select					= $bdd->prepare($tache_query);
	$pdo_select->bindValue		(':projet', 		$projetId, 	 PDO::PARAM_INT);
	$pdo_select->execute();
	$taches_principal			= $pdo_select->fetchAll();

	foreach ($taches_principal as $key) {
?>	<div class="tache" style="display: none;" >
		<div class="sousTacheDisplayer hidden">
			<p class="tache_titre">			<?php echo $key['intitule']; 	?> 	</p>
			<p class="dead_line_tache" >	<?php echo $key['dead_line']; 	?> 	</p>
			<p class="commentaire_tache">	<?php echo $key['commentaire']; ?> 	</p>
		</div>

		<div class="conteneurBouton clear">
			<input type="button" class="boutonValider" OnClick="modifierTache(<?php echo '\''.$key['intitule'].'\',\''.$key['dead_line'].'\',\''.$key['commentaire'].'\',\''.$key['id'].'\''; ?>)" 	value="Modifier">
			<input type="button" class="boutonValider" OnClick="supprimerTache(<?php echo $key['id']; ?>)" 	value="Supprimer">
		</div>
		
<?php 	$tache_mere_id = $key['id'];

		$sous_tache_query				= " SELECT * FROM tache 
		  									WHERE sous_tache_id = :idtache ;";
		  	$pdo_select					= $bdd->prepare($sous_tache_query); 
		  	$pdo_select->bindValue		(':idtache', 		$tache_mere_id, PDO::PARAM_INT);
		  	$pdo_select->execute();
		  	$sous_taches				= $pdo_select->fetchAll();

		foreach ($sous_taches as $ky ) {
?> 		<div class="sous_tache" style="display: none;"> 
			<p class="titre_sous_tache" >			<?php echo $ky['intitule']; 	?>		</p>
			<p class="dead_line_sous_tache"> 		<?php echo $ky['dead_line']; 	?>		</p>
			<p class="commentaire_sous_tache"> 		<?php echo $ky['commentaire']; 	?>		</p>
			<div class="conteneurBouton clear">
				<input type="button" class="boutonValider" OnClick="modifierTache(<?php echo '\''.$ky['intitule'].'\',\''.$ky['dead_line'].'\',\''.$ky['commentaire'].'\',\''.$ky['id'].'\''; ?>)" 	value="Modifier">
				<input type="button" class="boutonValider" OnClick="supprimerTache(<?php echo $ky['id']; ?>)" value="Supprimer">
			</div>
		</div> 

<?php	} ?>

		<div id="ProjetSousTacheBoxCRUD" class="ProjetSousTacheBoxCRUD titre hidden">
			<p>
				<label for="idProjetSousTacheBoxCRUD"> Ajouter une sous tache </label>		
			</p>
		</div>
		
		<div class="sousTacheCRUD hidden" style="display: none;">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="action" value="CreerTache">
				<input type="hidden" name="tacheMere" value="<?php echo $key['id']; ?>">
				<p><!-- Titre -->
					<label>Intitulé de la tache: <abbr title="obligatoire">*</abbr>: </label>
					<input type="text" name="intitule" value="" class="floatRight">
				</p>
				<p><!-- CDC -->
					<label>Commentaire: </label>
					<input type="text" name="commentaire" value="" class="floatRight">
				</p>	
				<p><!-- date dead line -->
					<label for="idProjetCDC">Dead-line de la tache : </label>
					<input type="text" name="deadline" class="deadlineTache deadline floatRight" min="<?php echo date("Y-m-d") ?>"><br>
				</p>
				<div class="conteneurBouton clear">								
					<input type="submit" value="creer" class="boutonValider">
				</div>
			</form>	
		</div>	
	</div>
<?php 
	}	
}
function utilisteurs_projet($bdd, $id_projet){
	$utilisateur_query			= " SELECT * FROM role 
									INNER JOIN utilisateur
									ON role.id_utilisateur = utilisateur.id
									WHERE id_projet = :id_projet;";

	$pdo_select					= $bdd->prepare($utilisateur_query);
	$pdo_select->bindValue		(':id_projet', 		$id_projet,		PDO::PARAM_INT);
	$pdo_select->execute();
	$utilisateurs				= $pdo_select->fetchAll();

	echo '<div class="utilisateur_du_projet_box" style="display: none;">';
	?> <table>
			<tr>	
				<td>Nom</td><td>Prenom</td><td>Fonction attribué</td><td>Ajouter/Enlever du projet</td>	
			</tr>
	<?php
	foreach ($utilisateurs as $key) {
		$arr= array('idd' => $key['id'], 'fonction_attribue' => $key['fonction_attribue']);
		$jSon = json_encode($arr);
	?>		<tr>
				<td><?php echo($key['nom']); ?></td><td><?php echo($key['prenom']); ?></td><td><?php echo($key['fonction_attribue']); ?></td><td OnClick='UpdateEquipierProjet( <?php echo($jSon); ?> )'><img class="false" src="images/buttonunset.JPG"></td>
			</tr>
	<?php
	}		
	echo '</table>';
}



function tous_utilisateurs($bdd){
	$utilisateur_query			= "SELECT * FROM utilisateur;";
	$pdo_select					= $bdd->prepare($utilisateur_query);
	$pdo_select->execute();
	$utilisateurs				= $pdo_select->fetchAll();
	$utilisateurs_nombre 		= $pdo_select->rowCount();
	if($utilisateurs_nombre > 0){
		echo '<div class="utilisateur_box" style="display: none;">';
		?> <table>
				<tr>	
					<td>Nom</td><td>Prenom</td><td>e-mail</td><td>Fonction par défaut</td><td>Ajouter au projet:</td>	
				</tr>
		<?php
		foreach ($utilisateurs as $key) {
			echo'<tr>
					<td>'.$key['nom'].'</td><td>'.$key['prenom'].'</td><td>'.$key['email'].'</td><td>'.$key['fonction'].'</td><td><img id="false" src="buttonunset.JPG"></td>
				</tr>';
		}		
		echo '</table>';
	}
}

function afficheToutProjet($bdd, $id){
	$utilisateur_query			= "SELECT * FROM role
									Where id_utilisateur = :id;";
	$pdo_select					= $bdd->prepare($utilisateur_query);
	$pdo_select->bindValue(		':id',		$id,			PDO::PARAM_INT);
	$pdo_select->execute();
	$utilisateurs				= $pdo_select->fetchAll();

	foreach ($utilisateurs as $key) {
		$projet_query 			= "SELECT * FROM projet
									WHERE id = :id;";
		$pdo_select				= $bdd->prepare($projet_query);
		$pdo_select->bindValue(	':id',		$key['id_projet'],		PDO::PARAM_INT);
		$pdo_select->execute();
		$projets				= $pdo_select->fetchAll();

		foreach ($projets as $ky) {
			?>
			<div class="projet box">
				<h4><?php echo $ky['titre']; ?></h4>
				<h4><?php echo $ky['dead_line']; ?></h4>

<?php 			if($_SESSION['isAdmin'] == 1){
	?>				<form method="post" action="Script_PHP/why.php">
						<input type="hidden" name="idProjet" value="<?php echo $ky['id']; ?>">
						<input type="submit" value="gérer" class="boutonValider">
					</form>
<?php 			}
?>				<form method="post" action="Script_PHP/why.php">
					<input type="hidden" name="idProjet" value="<?php echo $ky['id']; ?>">
					<input type="submit" value="Consulter" class="boutonValider">
				</form>
			</div> 
			<?php
		}
	}
}

