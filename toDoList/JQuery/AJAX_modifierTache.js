		function modifierTache(intitule, dead_line, commentaire, id){
			
			var intitule  = prompt("intitule de la tache:", intitule);
			var dead_line = prompt("Dead-line: ", dead_line);
			var commentaire  = prompt("commentaire: ", commentaire);

			$.post(
				"Script_PHP/AJAX_modifierTache.php",
				{
					id:id,
					intitule:intitule,
					dead_line:dead_line,
					commentaire,commentaire
				},
				function(data){

					location.reload();

				}
			);
		};