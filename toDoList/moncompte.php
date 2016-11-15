<?php
	session_start();
	include('Script_PHP/connectBDD.php');
?>
	<head>
		<meta charset="UTF-8"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="jQuery/AJAX_deleteArt.js"></script>
		<script type="text/javascript" src="jQuery/AJAX_ValideArticle.js"></script>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" type="text/css" href="styleAdmin.css"/>
		<link rel="stylesheet" type="text/css" href="main.css"/>

	</head>

<?php include('include/header.php'); ?>
<section id="compte">
<?php
	
		function displayProfileModifier(){
			$bdd=connect();
			$query_ut=mysqli_query($bdd,'SELECT * FROM utilisateur WHERE id='.$_SESSION['id'].'');
			include('include_HTML/displayInfosPerso.html');

		}include('module_photo.php');
		function displayArticlePublisher(){
			$bdd=connect();
			$queryRubrique=mysqli_query($bdd,'SELECT * FROM rubrique');
			include_once('include_HTML/displayPublisher.html');

		}
		function displayNote(){
			$bdd=connect();
			$query_note_com=mysqli_query($bdd,' SELECT note_com.valeur AS note, commentaire.contenu AS contenu,utilisateur.pseudo AS pseudo FROM commentaire
										INNER JOIN note_com ON note_com.commentaire_id=commentaire.id
										INNER JOIN utilisateur ON commentaire.auteur_id=utilisateur.id
										WHERE note_com.utilisateur_id='.$_SESSION['id'].'');

			$query_note_art=mysqli_query($bdd,' SELECT note_article.valeur AS note, article.titre AS titre,utilisateur.pseudo AS pseudo FROM article
										INNER JOIN note_article ON note_article.article_id=article.id
										INNER JOIN utilisateur ON article.auteur_id=utilisateur.id
										WHERE note_article.utilisateur_id='.$_SESSION['id'].'');		

				include_once('include_HTML/displayNote.html');

		}
		function displayCom(){
			$bdd=connect();
			$query_com=mysqli_query($bdd,'SELECT article.titre AS titre,
												commentaire.contenu AS contenu,
												commentaire.id AS id
											FROM commentaire
											INNER JOIN article ON commentaire.article_id=article.id
											WHERE commentaire.auteur_id='.$_SESSION['id'].'');
			if(mysqli_num_rows($query_com)){
				include('include_HTML/displayCom.html');
			}
			else{
				echo 'Vous n\'avez pas posté de commentaires';
			}
		}
		function displayPending(){
			$bdd=connect();
			$query_pending=mysqli_query($bdd,'SELECT article.titre AS titre,
										article.date AS date,
										utilisateur.pseudo AS auteur,
										article.id AS id
										FROM article 
										INNER JOIN utilisateur ON article.auteur_id=utilisateur.id WHERE isPending=1');
			include_once('include_HTML/displayPending.html');
		}
		function displayArticle(){
			$bdd=connect();
			$query_article=mysqli_query($bdd,	'SELECT article.titre AS titre,
										article.id AS id,
										article.date AS date,
										utilisateur.pseudo AS auteur,
										article.id AS id
										FROM article 
										INNER JOIN utilisateur ON article.auteur_id=utilisateur.id 
										WHERE article.auteur_id='.$_SESSION['id'].'');								
			include_once('include_HTML/displayArticle.html');
		}	
		function displayLus(){
			$bdd=connect();
			$query=mysqli_query($bdd,'SELECT article.titre AS titre,
										article.id AS id ,
										pseudo
										FROM article_lu
										INNER JOIN article ON article.id=article_lu.article_id 
										INNER JOIN utilisateur ON utilisateur.id=article_lu.utilisateur_id
										WHERE article_lu.utilisateur_id='.$_SESSION['id'].'');
			include_once('include_HTML/displayArtLu.html');
		}

	if(($_SESSION['id'])){
		$bdd=connect();
		$query=mysqli_query($bdd,' SELECT valeur FROM statut WHERE utilisateur_id='.$_SESSION['id'].'');
		$query2=mysqli_query($bdd,'SELECT * FROM utilisateur WHERE id='.$_SESSION['id'].'');
		$result=mysqli_fetch_array($query2);
		if($query){
			$statut=mysqli_fetch_array($query);
			switch($statut['valeur']){
				case 0:
					if(!$result['isBanned']){
						displayArticlePublisher();
					}
					else{
						echo'Vous êtes bannis et ne pouvez pas proposer d\'article';
					}
					displayProfileModifier();
					displayNote();
					displayCom();
					displayLus();
				break;
				
				case 1:
					if(!$result['isBanned']){
						displayArticlePublisher();
					}
					else{
						echo'Vous êtes bannis et ne pouvez pas proposer d\'article';
					}
					displayProfileModifier();
					displayNote();
					displayCom();
					displayArt();
					displayLus();
				break;
				case 2:
					if(!$result['isBanned']){
						displayArticlePublisher();
					}
					else{
						echo'Vous êtes bannis et ne pouvez pas proposer d\'article';
					}
					displayProfileModifier();
					displayNote();
					displayCom();
					displayArticle();
					displayPending();
					displayLus();
				break;
				case 3:
					if(!$result['isBanned']){
						displayArticlePublisher();
					}
					else{
						echo'Vous êtes bannis et ne pouvez pas proposer d\'article';
					}
					displayProfileModifier();
					displayNote();
					displayCom();
					displayArticle();
					displayPending();
					displayLus();
				break;
			
			}
		}
		
	}
	else{
		echo 'Vous n\'êtes pas enregistré';
	}
?>
</section>
<?php
	include('include/footer.php');
?>
