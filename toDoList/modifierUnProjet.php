<?php
session_start();
/* Temporaire */
if ($_SESSION['isAdmin'] != 1) {
	header('location: index.php');
}



$projetId  = $_SESSION['idProjet'];
$projet_id = $_SESSION['idProjet'];

require './Includes/includesKernel.php';
require './Includes/includesProjet.php';

// Si l'on a un formulaire pour creer une nouvelle Tache :
if 	(isset($_POST['action']) && $_POST['action'] == 'CreerTache'){
	$intitule = $_POST['intitule'];
	$commentaire = $_POST['commentaire'];
	$deadline =$_POST['deadline'];
	// Si la tache à ajouter est une sous tache:
	if(isset($_POST['tacheMere'])){
		$tache = new Tache($bdd, $intitule, $deadline, $commentaire, $projetId);
		$tache->isSousTache($_POST['tacheMere']);
		$tache->newTache();
	}
	// Si c'est une tache Principale
	else{
		$tache = new Tache($bdd, $intitule, $deadline, $commentaire, $projetId);
		$tache->newTache();
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Modifier un Projet</title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
		<link rel="stylesheet" href="<?php echo PATH_CSS ?>">
		<script type="text/javascript" src="JS/validFormulaire.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_supprimerTache.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_modifierTache.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_gerer_projet.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_UpdateEquipierProjet.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	</head>
	<body id="modifierUnProjet">
		<?php include_once('header.php'); ?>
		<article id="firstArticle">
			<!------------------------------------------------------ Gestion du projet ---------------------------------------->
			<div class="Box" id="generalModifierProjet">
				<div id ="generalModifierProjetTitre" class="titre hidden">
						<label for="idProjetGeneral"> Modification des informations du projet</label>		
				</div>
				<p><!-- Titre -->
					<label for="idProjetTitre">Titre du projet: <abbr title="obligatoire"></abbr>: </label><br><br>
					<input id="ProjetTitre" type="text" name="titre_projet" value="<?php echo $projet_titre; ?>	"><br><br>
					<div class="conteneurBouton clear">	
						<input type="button" class="boutonValider" OnClick="modifierTitreProjet(<?php echo '\''.$projetId.'\''; ?>)" value="Modifier">
					</div>
				</p>
				<div class="separateur"></div>
				<p><!-- Dead Line -->
					<label for="idProjetdeadline">Dead line du Projet: </label><br><br>
					<input type="text" id="Projetdeadline" class="deadline" name="deadline_projet" value="<?php echo $projet_dead_line; ?>"><br><br>
					<div class="conteneurBouton clear">	
						<input type="button" class="boutonValider" OnClick="modifierDeadLineProjet(<?php echo '\''.$projetId.'\''; ?>)" value="Modifier">
					</div>
				</p>
				<div class="separateur"></div>	
				<p><!-- CDC -->
					<label for="idProjetCDC">Cahier des charges: </label><br><br>
					<div class="conteneurBouton clear">	
						<input type="file" class="boutonValider" name="CDC_projet" value="">
					</div>
				</p>	
			</div>
		</article>
		<article>
			<!------------------------------------------------------ Gestion de l'equipe ---------------------------------------->
			<div id="ProjetEquipeBox" class="Box">
				<div id="ProjetEquipeBoxTitre" class="titre hidden">
						<label for="idProjetEquipe"> Definition et modification de l'équipe </label>
				</div>
				<div id=" ProjetEquipeBoxContenu" class="contenu">
					<?php 

					// SCRIPT_PHP/fonctions.php
						utilisteurs_projet($bdd, $projet_id);
						
					?>
				<!-- A FAIRE -->
				</div>
			</div>
		</article>
		<article>
			<!------------------------------------------------------ Gestion des Taches ---------------------------------------->
			<div id="ProjetTacheBox" class="Box" >
				<div id ="ProjetTacheBoxTitre" class="titre hidden">
					<p>
						<label for="idProjetTache"> Definition et modification des tâches </label>		
					</p>
				</div>
				<div id="ProjetTacheBoxCRUD"  class="titre hidden" style="display: none;">
					<p>
						<label for="idProjetTacheBoxCRUD"> Ajouter une tâche principal </label>		
					</p>
				</div>
				<div class="CRUD hidden clear" style="display: none;">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<input type="hidden" name="action" value="CreerTache">
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
							<input type="text" name="deadline" id="deadlineTache" class="floatRight" min="<?php echo date("Y-m-d") ?>" class="deadline"><br>
						</p>	
						<div class="conteneurBouton clear">						
							<input type="submit" value="creer" class="boutonValider " >
						</div>

					</form>	
				</div>
				<div id="ProjetTacheBoxContenu"  class="contenu">
					<?php // location: Script_PHP/fonctions.php
						affiche_taches($projetId, $bdd); 
					?>
				</div>
			</div>
		</article>
	</body>
</html>
<script type="text/javascript" src="JQuery/SCRIPT_PageModifierProjet_ShowHide.js"></script>
<?php include_once ('JQuery/JQueryUI+DatePicker.php'); ?>