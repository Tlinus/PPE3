<?php
	function bdd() 
		{
			$titre = 'Index du forum';
			$host='localhost';
			$bd='gdp';
			$user='root';
			
			try
				{
					$bdd= New PDO('mysql:host='.$host.'; dbname='.$bd, $user);
					$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
			catch (PDOExeption $error) 
				{
					printf('Erreur: ' .$error->getMessage());
					
					$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					exit(0);
				}
			
			return $bdd;
		}

	$bdd = bdd();