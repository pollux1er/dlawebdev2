function modifier_sp(ligne) {
	table = ligne.parentElement.parentElement.getAttribute('id');
	ths = document.getElementById(table).getElementsByTagName('thead')[0].getElementsByTagName('tr')[1].getElementsByTagName('th');
	tds = ligne.getElementsByTagName('td');
	
	var names = [];
	for (var i = 0 ; i < ths.length-1; i++) {
		names.push(ths[i].getElementsByTagName('a')[0].innerHTML);
		
		if (ths[i].style.display == "none"){ 
			continue;
		} else { a++;}
	}
	
	if(table == "tab_dir"){
		cible = document.getElementsByTagName('fieldset')[0];
		if(($('#methode_action').val() == '') || ($('#methode_action').val() == 'Ajouter'))
		{
			
			cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].disabled= "disabled";
			cible.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0].value = "Nouveau";
		}
		
		cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0].value = tds[0].innerHTML;
		cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].value = tds[1].innerHTML;
	}else {
		
			cible = document.getElementsByTagName('fieldset')[1];
		
		
		if(($('#methode_action').val() == '') || ($('#methode_action').val() == 'Ajouter'))
		{
			
			cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].disabled= "disabled";
			cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('select')[0].disabled= "disabled";
			cible.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0].value = "Nouveau";
		}
		
		cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0].value = tds[0].innerHTML;
		cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].value = tds[1].innerHTML;
		option = cible.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('select')[0];
		
		for(i = 0; i < option.length; i++)
		{
			if(option.options[i].value == tds[2].innerHTML)
			{
				option.options[i].selected = true;
			}
		}
	}
	
	
	// for(var i=1; i<tds.length-1; i++){
		// document.getElementById(names[i]).value = tds[i].innerHTML;
	// }
	
	
	
	return cible;
}

function modifier_form_1(a){
	Pparent = (a.parentElement).parentElement; 
	target = modifier_sp(Pparent);
	// alert(target);
	$('#methode_action').val("modifier");
	// alert(target.innerHTML);
	table = target.getElementsByTagName('table')[0];
	// alert(table.getAttribute('id'));
	if(table.getAttribute('id') == "Direction"){
		table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].disabled= false;
	}else{
		
		table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].disabled= false;
		table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('select')[0].disabled= false;
	} 
	
	annuler = table.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1];
	$(annuler).show();
	valider = table.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0];
	$(valider).val('Modifier');
	$(valider).css('visibility','visible');
	// alert($(valider).val());
}

function supprimer_form_1(a){
	Pparent = (a.parentElement).parentElement; 
	target = modifier_sp(Pparent);
	$('methode_action').val("supprimer");
	
	table = target.getElementsByTagName('table')[0];
	
	if(table.getAttribute('id') == "Direction"){
		table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].disabled= true;
	}else{
		
		table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1].disabled= true;
		table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('select')[0].disabled= true;
	} 
	$(table.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0]).css('visibility','hidden');
	$(table.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1]).css('display','none');
	
	Check = confirm("Vous etes sur le point d'effectuer une suppression! Etes vous sur de vouloir continuer ?"); 
	if(Check == false){
		$(table.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0]).css('visibility','visible');
		$(table.getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0]).val('Nouveau');
		alert("Suppression annulee");
	} else {
	
		var cmps = $('#'+table.getAttribute('id')+' tbody input:hidden, #'+table.getAttribute('id')+' tbody input:text, #'+table.getAttribute('id')+' tbody select');
		var data = [];
		
		$(cmps).each(function(){
			data.push(this.value);
		});
		
		// alert(data.length);
		
		val_mod_1(table.getAttribute('id'), data,"Supprimer");
	}
}

$('[name = valider]').each(function(){
	$(this).click(function(){
		form = this.parentElement.parentElement.parentElement.parentElement;
		inputs = form.getElementsByTagName('tr')[0].getElementsByTagName('input');
		selects = form.getElementsByTagName('tr')[0].getElementsByTagName('select');
		entity = form.getAttribute('id','false');
		if (this.value == "Nouveau")
		{
			for(var i = 0 ; i < inputs.length; i++)
			{
				inputs[i].disabled = false;
				inputs[i].value = "";
			}
			
			for(var i = 0 ; i < selects.length; i++)
			{
				selects[i].disabled = false;
				selects[i].value = "";
			}
			
			$(this.parentElement.getElementsByTagName('input')[0]).val('Ajouter');
			// $(this.parentElement.getElementsByTagName('input')[1]).show();
			
		}else{
			
			if(this.value == "Ajouter")
			{
				$('#methode_action').val('Ajouter');
			}else{
				$('#methode_action').val('Modifier');
			}
			
			
			var cmps = $('#'+entity+' tbody input:hidden, #'+entity+' tbody input:text, #'+entity+' tbody select');
			var data = [];
			
			$(cmps).each(function(){
				data.push(this.value);
			});
			
			// alert(data.length);
			
			val_mod_1(entity, data, $(this).val());
		}
	});
});

$('[name = annuler]').each(function(){
	$(this).click(function(){
		form = this.parentElement.parentElement.parentElement.parentElement;
		inputs = form.getElementsByTagName('tr')[0].getElementsByTagName('input');
		selects = form.getElementsByTagName('tr')[0].getElementsByTagName('select');
		
		$(this).hide();
		$('#methode_action').val('');
		
		for(var i = 0 ; i < inputs.length; i++)
		{
			inputs[i].value = "";
		}
		
		for(var i = 0 ; i < selects.length; i++)
		{
			selects[i].value = "";
		}
		
		this.parentElement.getElementsByTagName('input')[0].value = "Ajouter"; 
	});
});

function val_mod_1(entity, data, g)
{
	var post = "entity="+entity+"&";
	
	// alert(data.length);
	for (var i = 0; i < data.length; i++)
	{
		post += i+"="+data[i]+'&';
	}
	post = post+'val='+g;
	
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			mod_1(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	// alert(post);
	xhr.open("POST", "client/ajax_check_dir_dep", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(post);
}

function mod_1(Qdata)
{
	if(Qdata == "1")
	{
		$('#mess_text').html("<p>Ajout effectu&eacute; avec succ&egrave;s</p>");
		$('#message').css('display','block');
		$('#ex_mess').hide();
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

