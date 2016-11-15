<?php

session_start();
/* Temporaire */
$idUtilisateur = $_SESSION['utilisateurId'];
// fin temporaire


require './Includes/includesKernel.php';
require './Includes/includesProjet.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mes projets</title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
		<link rel="stylesheet" href="<?php echo PATH_CSS ?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	</head>
	<body id="mesProjets">
		<?php include_once('header.php'); ?>
	
	<div id="toutProjets">
		<div class="Box">
			<p><!-- Titre -->
				<label for="idToutProjet"> Mes Projets </label>
			</p>
			<div id="ToutProjetBoxContenu"  class="contenu Box">
			<?php // location: Script_PHP/fonctions.php
				afficheToutProjet($bdd, $idUtilisateur);
			?>
			</div>
		</div>
	</div>
	</body>
</html>