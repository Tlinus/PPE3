		function supprimerTache(id){
			$.post(
				"Script_PHP/AJAX_SupprimerTache.php",
				{
					id:id
				},
				function(data){

					location.reload();

				}
			);
		};