<?php
session_start();
require './Includes/includesKernel.php';
require './Includes/includesProjet.php';

// temporaire
$_POST['action'] = 'Creer';
// fin temporaire


if 	(isset($_POST['action']) && $_POST['action'] == 'Creer')   {	$projet_id 	= 0; }
else { header('Location: ./index.php'); }


if(isset($_POST['postform'])){ 
	echo "hello";
		$project = new projet($bdd, $_POST['titre_projet'], $_POST['deadline']);
		$_SESSION['idProjet'] = $project->newProject();
		header('location: ./modifierUnProjet.php');
}
?>
	
<!DOCTYPE html>
<html>
	<head>
		<title>Créer un projet</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="JS/validFormulaire.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript">
		    $(document).ready(function() {
		        $('.deadline').datepicker({ dateFormat: "yy-mm-dd"});
		    });
		</script>
	</head>
	<body>
	<?php include_once('header.php'); ?>
		<div id="creerProjet">
			<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit=" return newProjetValidFormulaire(); return false;">
				<input type="hidden" name="action" value="Creer">
				<input type="hidden" name="postform" value="new">
				<div>
					<h3> Creer un projet </h3>
					<p id="ProjetTitre"><!-- Titre -->
						<label for="idProjetTitre">Titre du projet: <abbr title="obligatoire"></abbr>: </label><br><br>
						<input type="text" name="titre_projet" id="titreProjet" value="">
					</p>
					<p id ="ProjetCDC"><!-- date dead line -->
						<label for="idProjetCDC">Dead-line du projet : </label><br><br>
						<input type="text" name="deadline" id="deadlineProjet" min="<?php echo date("Y-m-d") ?>" class="deadline"><br>
						
					</p>	
				</div>

				<!--<div id="ProjetEquipeBox" class="Box">
					<div id ="ProjetEquipeBoxTitre" class="titre">
						<h4>
							<label for="idProjetEquipe"> Definition de l'équipe </label>
						</h4>
					</div>
					<div id=" ProjetEquipeBoxContenu" class="contenu">
						<?php 
							tous_utilisateurs($bdd);
						?>
					</div>
				</div> -->
					<input type="submit" value="creer" class="boutonValider">
			</form>
		</div>
	</body>
</html>

