<?php
	Class Tache{

		private $id;
		private $projet;
		private $sous_tache_id;
		private $is_sstache;
		public $intitule;
		public $deadline;
		public $pdo;
		public $commentaire;
		public $done;
 

		public function __construct  ($pdo, $intitule, $deadline, $commentaire, $projet){
			$this->intitule 		= htmlspecialchars($intitule);
			$this->commentaire		= htmlspecialchars($commentaire);
			$this->deadline			= $deadline;
			$this->projet			= $projet;
			$this->pdo 				= $pdo;
			$this->sous_tache_id	= 0;
			$this->is_sstache		= 'NULL';
		}


		public function newTache(){
			$query =	"INSERT INTO tache
						(commentaire, intitule, id_projet, dead_line, sous_tache_id, is_sstache)
						VALUES 
						(:commentaire, :intitule, :id_projet, :dead, :sous_tache_id, :is_sstache);";
			
			$pdo_query = $this->pdo->prepare($query);
			$pdo_query->bindValue(':commentaire',		$this->commentaire,		PDO::PARAM_STR);  
			$pdo_query->bindValue(':intitule',			$this->intitule,		PDO::PARAM_STR);
			$pdo_query->bindValue(':id_projet',			$this->projet,			PDO::PARAM_INT);  
			$pdo_query->bindValue(':dead',				$this->deadline, 		PDO::PARAM_INT);
			$pdo_query->bindValue(':sous_tache_id',		$this->sous_tache_id,	PDO::PARAM_INT);  
			$pdo_query->bindValue(':is_sstache',		$this->is_sstache,		PDO::PARAM_INT);  
			$pdo_query->execute();

			$this->id = $this->pdo->lastInsertId();

			return $this->id;
		}

		public function isSousTache($idSousTache){
			$this->sous_tache_id	= $idSousTache;
			$this->is_sstache		= 1;
		}

	}
