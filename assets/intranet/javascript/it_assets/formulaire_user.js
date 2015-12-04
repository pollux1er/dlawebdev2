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
	xhr.open("POST", "user/ajax_module", true);
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
	
		
		var nom = 'Nouveau '+$('#nom_module').val();
		
		if($('#but_val').val() == nom)
		{
			ajouter_form();
			$('#methode_action').val('');
			
			$('#mod_body input:checkbox').each(function(){
				this.checked = false;
				this.disabled = false;
			});
			
		}else{
			
			trs = document.getElementById('tab_mod').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
						
			mods_params = "";
			noeud = "";
			for(var i = 0; i < trs.length; i++)
			{
				tds = trs[i].getElementsByTagName('td');
				
				mods_params += tds[0].getElementsByTagName('input')[1].value+',';
				if(tds[1].getElementsByTagName('input')[0].checked == true)
				{
					noeud = 1;
				}else{
					noeud = 0;
				}
				mods_params += noeud+',';
				
				if(tds[2].getElementsByTagName('input')[0].checked == true)
				{
					noeud = 1;
				}else{
					noeud = 0;
				}
				mods_params += noeud+'@';
			}
			
			// alert();
			
			var cmps = $('#tab_entity input:hidden, #tab_entity input:text, #tab_entity select');
			var data = [];
			for (var i = 0; i < cmps.length; i++ )
			{
				data.push(cmps[i].value);
			}
			// alert(data);
			val_mod($('#pass_recup').val(), data, $('#but_val').val(), mods_params);
		}
	});	
});

function val_mod(a, data, g, mp)
{ 
	var post = "a="+a+"&";
	for (var i = 0; i < data.length; i++)
	{
		post += i+"="+data[i]+'&';
	}
	post = post+'val='+g+'&mod_elts='+mp;
	// alert(post);
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			mod(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "user/ajax_check", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(post);
}
 
function mod(Qdata)
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

function first_(e){
	second = e.parentElement.parentElement.getElementsByTagName('td')[2].getElementsByTagName('input')[0];
	if(e.checked == true)
	{
		second.checked = true;
	}else{
		second.checked = false;
	}
};

function second_(e){
	first = e.parentElement.parentElement.getElementsByTagName('td')[1].getElementsByTagName('input')[0];
	if(e.checked == false)
	{
		first.checked = false;
	}
};

function maj_priv(cle, cible)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			maj(xhr.responseXML, cible); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "user/maj_priv", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('0='+cle);
}

function maj(data, oCible)
{
	// alert(data);
	// $(oCible).html("");
	
	var trs = document.getElementById(oCible).getElementsByTagName('tr');
	// alert(tr.length);
	
	var nodes = data.getElementsByTagName("item");
	var attrs = nodes[0].attributes;
	
	// var tr, td, span, inner, img;	
	
	
	for(var j=0; j<nodes.length; j++)
	{
		mod_intels = nodes[j].attributes[0].nodeValue;
		els = mod_intels.split('-');
		nom = els[1];
		for(var i=0; i<trs.length; i++)
		{
			var tds = trs[i].getElementsByTagName('td');
			if(tds[0].getElementsByTagName('input')[1].value == nom)
			{
				if(nodes[j].attributes[1].nodeValue != '0')
				{
					tds[1].getElementsByTagName('input')[0].checked = true;
				}else{
					tds[1].getElementsByTagName('input')[0].checked = false;
				}
				
				if(nodes[j].attributes[2].nodeValue != '0')
				{
					tds[2].getElementsByTagName('input')[0].checked = true;
				}else{
					tds[2].getElementsByTagName('input')[0].checked = false;
				}
				
				if (($('#methode_action').val() == "") || ($('#methode_action').val() == "Ajouter"))
				{
					tds[1].getElementsByTagName('input')[0].disabled = 'disabled';
					tds[2].getElementsByTagName('input')[0].disabled = 'disabled';
				}else{
					tds[1].getElementsByTagName('input')[0].disabled = '';
					tds[2].getElementsByTagName('input')[0].disabled = '';
				}
				
			}else{
				if (($('#methode_action').val() == "") || ($('#methode_action').val() == "Ajouter"))
				{
					tds[1].getElementsByTagName('input')[0].disabled = 'disabled';
					tds[2].getElementsByTagName('input')[0].disabled = 'disabled';
				}else{
					tds[1].getElementsByTagName('input')[0].disabled = '';
					tds[2].getElementsByTagName('input')[0].disabled = '';
				}
			}
		}
	}
	
	// var tr, td, span, inner, img;	
	// for(var j=0; j<nodes.length; j++)
	// {
		// tr = document.createElement('tr');
			// td1 = document.createElement('td');
			// td1.setAttribute('class','label');
			// td1.setAttribute('style','padding:5px;');
			
				// span = document.createElement('span');
				// span.setAttribute('style','float:right; z-index:20;');
				
					// img = document.createElement('img');
					// img.setAttribute('src',$('#imgurl').val()+'options.png');
					// img.setAttribute('onclick','move(this);');
				
				// span.appendChild(img);
				
			// td1.appendChild(span);
			
			// mod_intels = nodes[j].attributes[0].nodeValue;
			// els = mod_intels.split('-');
			
			// td1.appendChild(document.createTextNode(els[1]));
				// for(var i = 0; i<3 ; i++)
				// {
					// input = document.createElement('input');
					// input.setAttribute('type','hidden');
					// input.setAttribute('value',els[i]);
					
					// td1.appendChild(input);
				// }
			
		// tr.appendChild(td1);
		
			// td2 = document.createElement('td');
			// td2.setAttribute('align','center');
				// input1 = document.createElement('input');
				// input1.setAttribute('name','first');
				// input1.setAttribute('type','checkbox');
				// input1.setAttribute('onclick','first_(this);');
				
				// if(nodes[j].attributes[1].nodeValue != '0')
				// {
					// input1.setAttribute('checked','checked');

				// }
				
				// if (($('#methode_action').val() == "") || ($('#methode_action').val() == "Ajouter"))
				// {
					// input1.setAttribute('disabled','disabled');
				// }
			// td2.appendChild(input1);
		
		// tr.appendChild(td2);
			// td3 = document.createElement('td');
			// td3.setAttribute('align','center');
				// input2 = document.createElement('input');
				// input2.setAttribute('name','second');
				// input2.setAttribute('type','checkbox');
				// input2.setAttribute('onclick','second_(this);');
				
				// if(nodes[j].attributes[2].nodeValue != '0')
				// {
					// input2.setAttribute('checked','checked');
				// }
				// if (($('#methode_action').val() == "") || ($('#methode_action').val() == "Ajouter"))
				// {
					// input2.setAttribute('disabled','disabled');
				// }
			// td3.appendChild(input2);
		
		// tr.appendChild(td3);
		
		// $(oCible).append(tr);
	// }
}



















