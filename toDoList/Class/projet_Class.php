<?php 
	
	Class projet{

		public $titre;
		public $cdc;
		public $deadline;
		public $pdo;

		public function __construct  ($pdo, $titre, $deadline){
			$this->titre 	= htmlspecialchars($titre);
			//$this->cdc 		= $cdc;
			$this->deadline	= $deadline;
			$this->pdo 		= $pdo;
		}


		public function newProject(){

			$query =	"INSERT INTO projet
						(titre, dead_line)
						VALUES 
						(:titre, :dead);";
			$pdo_query = $this->pdo->prepare($query);
			$pdo_query->bindValue(':titre',		$this->titre,		PDO::PARAM_STR);  
			$pdo_query->bindValue(':dead',		$this->deadline, 	PDO::PARAM_INT);
			$pdo_query->execute();

			return $lastId = $this->pdo->lastInsertId();
		}


	}
