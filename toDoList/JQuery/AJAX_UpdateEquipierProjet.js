function UpdateEquipierProjet(arr){
	

	$.post(
		"Script_PHP/AJAX_UpdateEquipierProjet.php",
		{
			
		},
		function(data){
				
				location.reload();
			alert(JSON.parse(data));
			}
		);
};