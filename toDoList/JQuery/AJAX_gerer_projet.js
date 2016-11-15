		function modifierTitreProjet(id){
			
			var titre= $('#ProjetTitre').attr('value');
			alert(titre);
			$.post(
				"Script_PHP/AJAX_modifierTitreProjet.php",
				{
					titre:titre,
					id:id
				},
				function(data){

					location.reload();

				}
			);
		};

		function modifierDeadLineProjet(id){
			
			var DL= $('#Projetdeadline').attr('value');
			alert(DL);
			$.post(
				"Script_PHP/AJAX_modifierDeadLineProjet.php",
				{
					DL:DL,
					id:id
				},
				function(data){

					location.reload();

				}
			);
		};