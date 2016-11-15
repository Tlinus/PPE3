<?php
// je ne t'ai pas commenter toutes les initialisation de variable je pense que t'auras compris...
//include 'function.php';
	class inscription
	{
		private $fonction;
		private	$email;
		private $mdp;
		private $mdp2;
		private $nom;
		private $prenom;
		private $avatar;
		public  $bdd;

		public function __construct($fonction, $email, $mdp, $mdp2, $nom, $prenom, $avatar, $bdd) 
		{
			$fonction 	= htmlspecialchars($fonction);
			$email 		= htmlspecialchars($email);
			$nom 		= htmlspecialchars($nom);
			$prenom 	= htmlspecialchars($prenom);
			$avatar		= htmlspecialchars($avatar);

			
			$this->fonction = $fonction;
			$this->email 	= $email;
			$this->mdp 		= $mdp;
			$this->mdp2 	= $mdp2;
			$this->nom 		= $nom;
			$this->prenom 	= $prenom;
			$this->avatar	= $avatar;
			$this->bdd 		= $bdd;
		}
		
		
		public function verif()
			{
				if(strlen($this->fonction) > 0 AND strlen($this->fonction) < 50 )
					{// si le pseudo est bon
						// on tchek la syntacxe du mail
						
						$syntaxe = ' #^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
						if(preg_match($syntaxe, $this->email))
							{	//si la syntaxe du mail est bon
								//on tcheck si le mot de passe à entre 5 et 20 caractéres
								if(strlen($this->mdp) > 5 AND strlen($this->mdp) < 20)
									{//si le mot de pase est bon
										// on tcheck si les deux mots ddfe passes sont identiques...
										if($this->mdp == $this->mdp2) 
											{
												$syntaxe = '#^[a-zA-Z_]{3,30}$# ';
												if(preg_match($syntaxe,$this->nom) AND preg_match($syntaxe,$this->prenom))
													{
														return 'ok';
													}
												else {
													$erreur = ' Vos Nom et Prenom doivent contenir entre 3 et 30 caracteres, et ne pas contenir de caractéres spéciaux';
												}
											}
										else
											{ /* les deux mots de passes sont mauvais */
												$erreur=' Les mots de passes renseignés ne sont pas identiques! ';
												return $erreur;
											}
									}
								else 
									{/* le premier mot de passe ne contient pas entre 5 et 20 caractéres */
										$erreur=' Le  mot de passe doit contenir entre 5 et 20 caractéres';
										return $erreur;
									}
							}
							
						else 
							{ /* email mauvais */
								$erreur = 'Syntaxe de l\'adresse email incorrect ';
								return $erreur;
							}
							
					}
					
				else
					{
					//Fonction non renseigné
						$erreur = 'Vous devez renseigner votre fonction au sein de l\'entreprise';
						return $erreur;
					}
				
			}
		
		public function enregistrement()
			{
				$requete = $this->bdd->prepare('INSERT INTO utilisateur (nom, prenom, email, fonction, avatar, mdp) VALUES (:nom, :prenom, :email, :fonction, :avatar, :mdp)');
				$requete->execute(array(
					':nom' => $this->nom,
					':prenom' => $this->prenom,
					':email' => $this->email,
					':fonction' => $this->fonction,
					':avatar' => $this->avatar,
					':mdp' => $this->mdp
				));
				return 1;
			}
		
		public function  session()
			{
				$_SESSION['utilisateurId'] = $this->bdd->lastInsertId();
				$_SESSION['isAdmin'] = 0;
				$_SESSION['mail'] = $this->email;
				return 1;
			}
				
	}