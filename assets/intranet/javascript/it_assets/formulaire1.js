$(function(){
	$('#but_val').click(function(){
	
		var act = "";
		var nom = 'Nouveau '+$('#nom_module').val();
		
		if($('#but_val').val() == nom)
		{
			ajouter_form();
			$('#methode_action').val('');
			
		}else{
			
			var cmps = $('#tab_entity input:hidden, #tab_entity input:text, #tab_entity select');
			var data = [];
			for (var i = 0; i < cmps.length; i++ )
			{
				data.push(cmps[i].value);
			}
			// alert(act);
			val_mod(data, $('#but_val').val());
		}
	});	
});

function val_mod(data, g)
{
	var post = "";
	for (var i = 0; i < data.length; i++)
	{
		post += i+"="+data[i]+'&';
	}
	post += post+'val='+g;
	
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			mod(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "client/ajax_check", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(post);
}
 
function mod(Qdata)
{
	// alert(Qdata);
	if(Qdata == "1")
	{
		$('#mess_text').html("<p>Ajout effectu&eacute; avec succ&egrave;s</p>");
		$('#message').css('display','block');
		$('#ex_mess').hide();
		// $('#tab_entity input:text, #tab_entity select').each(function(){
			// $(this).val("");
		// });
		window.setTimeout(function(){$('#message').fadeOut();} , 1500);
		window.setTimeout(function(){$('#form_insert').submit();} , 2000);
	}else if(Qdata == "2")
	{
		$('#mess_text').html("<p>Modification effectu&eacute;e avec succ&egrave;s</p>");
		$('#message').css('display','block');
		$('#ex_mess').hide();
		window.setTimeout(function(){$('#message').fadeOut();} , 1500);
		window.setTimeout(function(){$('#form_insert').submit();} , 2000);
	}else if(Qdata == "3")
	{
		$('#mess_text').html("<p>Suppression effectu&eacute;e avec succ&egrave;s</p>");
		$('#message').css('display','block');
		$('#ex_mess').hide();
		window.setTimeout(function(){$('#message').fadeOut();} , 1500);
		window.setTimeout(function(){$('#form_insert').submit();} , 2000);
	}else
	{
		$('#mess_text').html(Qdata);
		$('#message').css('display','block');
		$('#ex_mess').show();
	}
	
}

