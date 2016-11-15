<?php


class connexion
{
	private $nom;
	private $prenom;
	private	$email;
	private $bdd;
	
	public function __construct($nom, $prenom, $mdp)
		{
			$this->nom 		= $nom;
			$this->prenom 	= $prenom;
			$this->mdp 		= $mdp;
			$this->bdd 		= bdd();
		}
	public function verif()
		{
			$requete = $this->bdd->prepare('SELECT * FROM utilisateur 
											WHERE nom = :nom 
											AND prenom = :prenom');
			$requete->execute(array(
											':nom' 		=> $this->nom,
											':prenom' 	=> $this->prenom
								));
			$reponse = $requete->fetch();

			if($reponse)
				{
					if ($this->mdp == $reponse['mdp'])
						{
							return 'ok';
						}
					else 
						{
							$erreur = 'le mot de passe est incorrect';
							return $erreur;
						}
				}
			else
				{
					$erreur ='La combinaison Nom & Prenom est incorect.';
					return $erreur;
				}
		}
	public function  session()
		{
			$requete = $this->bdd->prepare('SELECT * FROM utilisateur WHERE nom = :nom AND prenom= :prenom');
			$requete->execute(array(':nom' => $this->nom, ':prenom' => $this->prenom));
			$requete = $requete->fetch();
			$_SESSION['utilisateurId'] = $requete['id'];
			$_SESSION['isAdmin'] = $requete['is_admin'];
			$_SESSION['mail'] =$requete['email'];
			return 1;
		}
}