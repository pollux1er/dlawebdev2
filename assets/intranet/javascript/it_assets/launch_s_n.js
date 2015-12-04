function launch_sn(a, b, c, l)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			launch(xhr.responseText, l);
		}
	};
	
	xhr.open("POST", "materiel/launch_sn" , true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("1="+a+"&2="+b+"&3="+c);
}

function launch(oData, ligne)
{
	// alert(oData);
	if(oData == 'ok')
	{
		$('#mess_text').html("<p>Chargement bien effectu&eacute;</p>");
		$('#message').show();
		$('#ex_mess').hide();
		window.setTimeout(function(){ $('#message').hide()}, 1500);
		
		window.setTimeout(function(){load_mat(); $(ligne).fadeOut()}, 1800);
		refresh_sn_nad();
		search($('#numpomat').val(),  $('#serial').val(), $('#typemat').val(), $('#modemat').val(), $('#statmat').val(), $('#nomeqpt').val(), $('#sh_mat'));
		//il faut mettre à jour les sn
	}else
	{
		$('#ex_mess').show();
		$('#mess_text').html(oData);
		$('#message').show();
	}
	
}