<?php
//temporaire 
$_SESSION['idProjet'] =  16;
// Fin temporaire

$projetId = $_SESSION['idProjet'];
require './Includes/includesKernel.php';
require './Includes/includesProjet.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gerer un projet</title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	</head>
	<body id="gererProjet">
		<?php include_once('header.php'); ?>
			<div class="Box" id="generalGererProjet">
				<h1><?php echo $projet_titre; ?> </h1>
				<h3><?php echo  $projet_dead_line ?></h3>
			
			<?php affiche_taches_only($projetId, $bdd); ?>
			</div>
	</body>
</html>
<script>
	function showHide(idAClicker, classACacher){
		$(idAClicker).click(function(){
			if($(idAClicker).hasClass("hidden")) {
				$(classACacher).show();
				$(idAClicker).toggleClass("shown");
				$(idAClicker).removeClass("hidden");

			} 
			else{
				$(classACacher).hide();
				$(idAClicker).toggleClass("hidden");
				$(idAClicker).removeClass("shown");

			}
		});
	}

	function showHide2(idAClicker, classACacher, classACacher2){
		$(idAClicker).click(function(){
			if($(idAClicker).hasClass("hidden")) {
				$(classACacher).show();
				$(classACacher2).show();
				$(idAClicker).toggleClass("shown");
				$(idAClicker).removeClass("hidden");

			} 
			else{
				$(classACacher).hide();
				$(classACacher2).hide();
				$(idAClicker).toggleClass("hidden");
				$(idAClicker).removeClass("shown");

			}
		});
	}

	showHide2('.sousTacheDisplayer', '.tache', '#ProjetTacheBoxCRUD');
	showHide('#ProjetTacheBoxCRUD', '.CRUD' );
	showHide('#ProjetSousTacheBoxCRUD', '.sousTacheCRUD');

</script>