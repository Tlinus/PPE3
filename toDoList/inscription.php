<?php 
	session_start(); 
require './Includes/includesKernel.php';
require './Class/inscription_Class.php';
	//include 'function.php';
	$bdd = bdd();
	
	// on verifie si on a un formulaire qui nous est retourné (au complet ^^)
	if(isset($_POST['nom']) AND isset($_POST['email']) AND isset($_POST['mdp']) AND  isset($_POST['mdp2']))
		{	// Si on a un formulaire remplie on envoie à la class
			$inscription = new inscription($_POST['fonction'],$_POST['email'],$_POST['mdp'],$_POST['mdp2'], $_POST['nom'], $_POST['prenom'], $_POST['avatar'], $bdd);
			// on va verifier les syntaxes correspondances etc... (voir la fonction)
			$verif = $inscription->verif();
			// si tout est bon au niveau des syntaxes...
			// BIG BONUS ->>>> ATTENTION! pour l'instant on ne vérifie pas si les pseudos  et e-mail entrés sont en conflits avec des données déjà existentes....
			if($verif  == "ok"){	
					// on verifie que les données sont stocker sur la bdd
				if($inscription->enregistrement()){

				// tout est bon pour l'enregistrement
				// on initialise  la session
					if($inscription->session()){	
							header('Location: index.php'); 
					}
					else{
						$erreur= 'une erreur est survenue';
					}
				}
				else{
					$erreur= 'une erreur est survenue lors de l\'enregistrement Veuillez essayer à nouveau';
				}
			}
			else{
			// si les données entrées ne sont pas correctes on enregistre le message d'erreur dans la variable $erreur
				$erreur = $verif; 
			}
		}
		else{
			$erreur =" Veuillez renseigner les champs obligatoires";
		}
?>
<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">

	<!-- Java script pour permettre de confirmer mot de passe sans passer par php -->

	<script type="text/javascript">
	function checkMe() {
		var pass1 = document.getElementById("mdp").value;
		var pass2 = document.getElementById("mdp2").value;

		if (pass1==pass2) {
			pass1=pass2;
			document.getElementById("form").submit();
			return true;
		
		}else {
			alert("Les mots de passe ne sont pas identiques");
			return false;
		}

	}
	</script>

	<title></title>
</head>
<body>
	<?php include_once('header.php'); ?>
	<form method="post" action="inscription.php" id="form">

		</br>
		</br>
	
		<p><i>Complétez le formulaire. Les champs marqué par </i><em>*</em> sont <em>obligatoires</em></p>


  	<fieldset>
    <legend>INFORMATIONS PERSONNELLES</legend>

			<label for="prenom"> PRENOM   <span>*</span></label> 
			<input type="text" name="prenom" id="prenom" autofocus="" required=""/>
			</br>


			<label for="nom"> NOM   <span>*</span></label>
			<input type="text" name="nom" id="nom" autofocus="" required=""/>
			</br>

        	<label for="email"> Email   <span>*</span></label>
    		<input type="email"  name="email"    id="email" autofocus="" required=""/>
    		</br>

    <legend>PROFIL</legend>
		
			<label for="fonction">FONCTION   <span>*</span></label>
    		<input type="text" name="fonction" id="fonction" autofocus="" required=""/>
    		</br>

			<label for="avatar">AVATAR </label>
    		<input type="text" name="avatar" placeholder="www.monimage.com" id="avatar" />
    		</br>
    	

       
       		<label for="pass"> Mot de passe   <span>*</span></label>
       		<input type="password" name="mdp" id="pass" />
       		</br>

    	
       		<label for="passconf">Confirmer votre Mot de passe   <span>*</span></label>
       		<input type="password" name="mdp2" id="passconf" autofocus="" required=""/>
       		</br>
       
		</fieldset>
			<br/>

			<INPUT TYPE="submit" NAME="envoyer" VALUE=" Envoyer " id="envoyer" onclick=" return checkMe()" >
			<INPUT TYPE="reset" NAME="annuler" VALUE=" Annuler ">
			<a href="index.php"><INPUT TYPE="button" Name="retout" VALUE="Retour au site" ></a></td>
		
	</form>	
       <h2> <?php if (isset($erreur)) echo $erreur;?> </h2>
</body>
</html>

