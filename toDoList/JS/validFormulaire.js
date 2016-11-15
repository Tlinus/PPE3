/* Validation des différents formulaires
-------------------------------------------------------------

-------------------------------------------------------------
Formulaire Nouveau Projet */
function newProjetValidFormulaire(){
	var error 		= '';	
	var setfocus 	= 0;
	idProjetTitre		= document.getElementById('titreProjet');
	idProjetDeadline	= document.getElementById('deadlineProjet');

	/* Champs obligatoires */
	if(idProjetTitre.value=='') {
		error += '- Titre du projet\n';
		if(setfocus==0) { idProjetTitre.focus(); }
		setfocus += 1;
		console.log('idProjetTitre check false');
	}

	if(idProjetDeadline.value=='') {
		error += '- Dead-line du Projet\n';
		if(setfocus==0) { idProjetDeadline.focus(); }
		setfocus += 1;
		console.log('idProjetDeadline check false');

	}
	//	testDeadLine = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(idProjetDeadline.value);
	

	if(error!='') {
		if(setfocus==1) { alert('Veuillez remplir le champ suivant :\n' + error); }
		else { alert('Veuillez remplir les champs suivants :\n' + error); }
		console.log('error == true');
		return false;
	}
	/*else if(testDeadLine != 1){
		alert('Le champs dead-line doit être du type AAAA-MM-JJ' );
		return false;
	}*/
	else if(Date.parse(idProjetDeadline.value) <= Date.now()){
		alert('La dead-line du projet ne peut être antérieure ou égale à la date d\'aujourd\'hui');
		console.log('error dead-line == true');
		return false;
	}
	else {
		/* on envoie le formulaire */
		console.log('error == false');
		return true;
	}
	console.log('ne doit pas s\'afficher');
}

