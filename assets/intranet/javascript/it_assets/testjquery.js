$('input[name$="recherche"]').keyup(function() {
	show();
});
$('input[name$="recherche"]').click(function() {
	show();
});

function show() {
	// $(this).select();

	var url_ajax = $('#form_search').attr('action');
	var method_ajax = $('#form_search').attr('method');
	// alert($('#form_search').serialize());

	$.ajax({
		url : url_ajax,
		type : method_ajax,
		data : $('#form_search').serialize() + '&ajax=TRUE',
		dataType : 'html',
		success : function(code_html) {
// alert(code_html);
			// alert("cool");
			$('#result_ajax').empty();
			$("#result_ajax").append(code_html);
// $('#list').empty();
// $('#list').append(code_html);
			tdelt = $('td', $("#results")[0]);// .getElementsByTagName;
			thelt = $('th');
			longeur = thelt.length;
			tete = $("#tete");
			if (tdelt.length > 2) {
				if (resultats.getHeight() > 350) {
					tete.attrib("class", "crolling");// = "crolling";

				}
				for ( var i = 0; i < longeur; i++) {
					thelt[i].width = tdelt[i].getWidth();

				}
			}
			$("#result_ajax").css("display", "none");
			$("#result_ajax").fadeIn();
//			$("#result_ajax").slideDown('slow').show; 

		},
		error : function(resultat, statut, erreur) {

		},
		complete : function(resultat, statut) {
		}
	});

};

$('select[name$="recherche"]').keyup(function() {
	show();
});

$('select[name$="recherche"]').click(function() {
	show();
});



if ($('#Oui[checked="checked"]').length > 0){
	$("#paramrecommandeur").css('display', 'block');
}


statusouvert1 = $('[name="statusouvert1"]');
for (var i=0; i<statusouvert1.length; i++){


	document.getElementsByName($('[name="statusouvert1"]')[0].id)[0].style.display = "none";
	if (statusouvert1[i].value== "ouvert"){
		document.getElementsByName($('[name="statusouvert1"]')[0].id)[0].style.display = "block";
		break;
		}
}
var nameaouvrir;

$('[name="statusouvert"]').each(function(index){
	nameaouvrir = this.id;
	if(this.value == "ouvert"){
		
		if (document.getElementsByName(nameaouvrir)[0] !=null)
		document.getElementsByName(nameaouvrir)[0].style.display = "block";
		
		}
	else
	document.getElementsByName(nameaouvrir)[0].style.display = "none";
});



$('input[name="nom"]').blur(function() {
	showError();
});
$('input[name="prenom"]').blur(function() {
	showError();
});
$('input[name="datenaissance"]').blur(function() {
	showError();
});

function showError() {
	// $(this).select();

	var url_ajax = "messagenom";
	var method_ajax = $('#form_insert').attr('method');
	// alert($('#form_search').serialize());

	$
			.ajax({
				url : url_ajax,
				type : method_ajax,
				data : $('#form_insert').serialize() + '&ajax=TRUE',
				dataType : 'html',
				success : function(code_html) {
					// alert(code_html);
					// alert("cool");

					message = code_html.split(" ");
					$('#messagenom').empty();
					$('#messageprenom').empty();
					$('#messagedatenaissance').empty();
					if (message[0] == "nom") {
						$("#messagenom").append(
								"Un demandeur de ce nom a déja été enregistré");
						// alert(code_html);
					}
					if (message[0] == "prenom") {
						$("#messageprenom")
								.append(
										"Un demandeur de meme nom et de meme prenom a déja été enregistré");
						// alert(code_html);
					}
					if (message[0] == "datenaissance") {
						$("#messagedatenaissance")
								.append(
										'Ce demandeur a déjà  été enregistré, veuillez le modifier&ensp;<img src="'
												+ base
												+ 'modifier.png" title="modifier" class="modif" onclick="$(\'#messagedatenaissance\').empty();modifier_formdem(1,'
												+ message[1] + ')" />');
					}

				},
				error : function(resultat, statut, erreur) {

				},
				complete : function(resultat, statut) {
				}
			});

};

