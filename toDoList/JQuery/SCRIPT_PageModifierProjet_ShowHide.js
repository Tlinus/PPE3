$(document).ready(function(){
	function showHide(idAClicker, classACacher){
		$(idAClicker).click(function(){
			if($(idAClicker).hasClass("hidden")) {
				$(classACacher).show();
				$(idAClicker).toggleClass("shown");
				$(idAClicker).removeClass("hidden");

			} 
			else{
				$(classACacher).hide();
				$(idAClicker).toggleClass("hidden");
				$(idAClicker).removeClass("shown");

			}
		});
	}
	showHide('#ProjetTacheBoxCRUD', '.CRUD' );
	showHide('.sousTacheDisplayer', '.sous_tache');
	//showHide('#ProjetSousTacheBoxCRUD', '.ProjetSousTacheBoxCRUD');

	function showHide2(idAClicker, classACacher, classACacher2, classACacher3){
		$(idAClicker).click(function(){
			if($(idAClicker).hasClass("hidden")) {
				$(classACacher).show();
				$(classACacher2).show();						
				$(idAClicker).toggleClass("shown");
				$(idAClicker).removeClass("hidden");

			} 
			else{
				$(classACacher).hide();
				$(classACacher2).hide();
				$(classACacher3).hide();
				$(idAClicker).toggleClass("hidden");
				$(idAClicker).removeClass("shown");
			}
		});
	}
	showHide2('#ProjetTacheBoxTitre', '.tache', '#ProjetTacheBoxCRUD', '.CRUD');

	function showHideEnfant(idAClicker, classEnfantACacher){
		$(idAClicker).click(function(){
			if($(idAClicker).hasClass("hidden")) {
				$(idAClicker).next(classEnfantACacher).show();
				$(idAClicker).toggleClass("shown");
				$(idAClicker).removeClass("hidden");

			} 
			else{
				$(idAClicker).next(classEnfantACacher).hide();
				$(idAClicker).toggleClass("hidden");
				$(idAClicker).removeClass("shown");

			}
		});
	}

	showHideEnfant('#ProjetSousTacheBoxCRUD', '.sousTacheCRUD');
	

	/*$('#ProjetTacheBoxContenu').on('click', '.ProjetSousTacheBoxCRUD',  function(){
		if($('.ProjetSousTacheBoxCRUD').hasClass("hidden")) {
			$(this).find('.sousTacheCRUD').show();
			$('.ProjetSousTacheBoxCRUD').toggleClass("shown");
			$('.ProjetSousTacheBoxCRUD').removeClass("hidden");
		} 
		else{
			$(this).find('.sousTacheCRUD').hide();
			$('.ProjetSousTacheBoxCRUD').toggleClass("hidden");
			$('.ProjetSousTacheBoxCRUD').removeClass("shown");

		}

	});*/

	
	$('#ProjetEquipeBoxTitre').click(function(){
		if($('#ProjetEquipeBoxTitre').hasClass("hidden")) {
			$('.utilisateur_du_projet_box').show();
			$('#ProjetEquipeBoxTitre').toggleClass("shown");
			$('#ProjetEquipeBoxTitre').removeClass("hidden");
		}
		else{
			$('.utilisateur_du_projet_box').hide();
			$('#ProjetEquipeBoxTitre').toggleClass("hidden");
			$('#ProjetEquipeBoxTitre').removeClass("shown");
		}
	});


	$('.false').click(function(){
		$('.false').attr('src', './images/buttonvalid.jpg');
		$('.false').toggleClass("true");
		$('.true').removeClass("false");
	});

	$('.true').click(function(){
		$('.true').attr('src', './images/buttonunset.JPG');
		$('.true').toggleClass("false");
		$('.false').removeClass("true");
	});
});