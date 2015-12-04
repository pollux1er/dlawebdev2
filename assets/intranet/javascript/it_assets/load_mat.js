function load_mat() {
	// alert('');
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			load(xhr.responseText);
		}
	};
	
	if(($('#module').val() == "Commande") || ($('#module').val() == "Materiel")){
		lien = "commande/count_mat";
	}else if(($('#module').val() == "Recherche") || ($('#nom_module').val() == "Client") || ($('#nom_module').val() == "User")){
		lien = "./commande/count_mat";
	}else{
		lien = "../commande/count_mat";
	}
	
	xhr.open("GET",lien, true);
	xhr.send(null);
}

function load(data)
{
	// alert(data);
	
	var i = 0
	$('.a_mat, .a_mat_left, .a_mat_stat').each(function(){
		$(this).html(data);
	});
	
	if(data != "0")
	{
		$('.a_mat, #mat_alert').each(function(){
			$(this).show();
		});
	}else
	{
		$('.a_mat, #mat_alert').each(function(){
			$(this).hide();
		});
		if($('#module').val() == "Materiel")
		{
			$('#info_sn').hide();
		}
	}
}

load_mat();
