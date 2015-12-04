$('#supp_dtl').click(function(){
	var check = confirm("Voulez vous vrament suppirmer cet enregistrement?");
	if(check)
	{
		supp_($('#recup_po').val(), $('#iddet_cmd').val(), $('#sh_dtl'));
	}else 
	{
		alert("suppression annulee");
	}
});

function supp_(a, b, c)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			supp(xhr.responseText, c, a); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "commande/ajax_sup_det", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+b);
}

function supp(data, target, oA)
{
	if(data == 'vide')
	{
		var check = confirm("La commande ne contient plus aucun élément... cliquer \"Ok\" pour retirer le PO de la liste \"Annuler\" pour pouvoir y rajouter des elements");
		if (check)
		{
			// alert('there');
			sup_cmd(oA);
		}else{
			ajouter_dtl();
		}
		
	}else{
		$('#mess_text').html(data);
		$('#message').css('display','block');
		$('#ex_mess').hide();
		window.setTimeout(function(){
			$('#message').fadeOut(); 
			$('#saisie input:text, #saisie select').val(""); 
			$('#det_comd input:text, #det_comd select').val(""); 
			$('#det_comd').fadeOut(); 
		}, 2000);
		details(oA, target);
		load_mat($('.a_mat'));
	}
}