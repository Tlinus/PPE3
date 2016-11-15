<?php
   session_start();

   require './Includes/includesKernel.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Mes projets</title>
      <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
      <link rel="stylesheet" href="<?php echo PATH_CSS ?>">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

   </head>
   <body id="connexion">
      <?php include_once('header.php'); ?>
     <h3>Login</h3>
        
         <form id="login" method="post" action=" <?php $path = $_SERVER['PHP_SELF']; $file = basename($path); echo$file ; // ces 3 dernieres commandes servent à renvoyer le formulaire sur la page qui etait afficher juste avant le try login ?> "> 
            <li>Nom: <input name="nom" type="text" placeholder=" " required /></li>
            <li>Prenom <input name="prenom" type="text" placeholder=" " required /></li>
            <li>Mot de passe: <input type="password" name="mdp" placeholer="Mot de passe ..." required /></li>
            <li><input type="submit" value="Se connecter"/></li>
            <!-- si il n'a pas de compte activer on lui propose d'en creer un! -->
            <li><a href="inscription.php"> Enregistrer un nouveau compte </a></li> 
         </form>

<?php 
      //include ('include/connexionbdd.php');
      include 'Class/connexion_Class.php';
      $bdd= bdd(); // connexion à la bdd
      // Si on récupére le post d'un formulaire :
      if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mdp']))
         {  //on envoie les données à la class connexion
            $connexion = new connexion($_POST['nom'], $_POST['prenom'], $_POST['mdp']);
            $verif = $connexion->verif();
            // on verifie si les données entrés par l'utilisateur sont bonnes
            // BONUS Cette partie n'est pas términé  entierement 
            if ($verif == 'ok')
               {  // on verifie que les données ont bien été assimiler par la bdd
                  if($connexion->session())
                     {
                        //si tou est ok on peut afficher un javascript alert "connecter", bon là ça n'a pas marcher ...
                        echo "<script> alert('connecter') </script>";
                        header('Location: index.php');
                     }
               }
            else
               {
                  // si les données utilisateurs ne sont pas bonnes  on stocke le message d'erreur dans une variable creer pour l'occasion : erreur 2
                  $erreur2=$verif;
               }
         }
//si erreur2 existe on l'affiche
                        if (isset($erreur2)){echo'<li>'.$erreur2.'</li>';} 
                     ?>

