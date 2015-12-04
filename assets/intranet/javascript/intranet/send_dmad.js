function send_dmad(a)
{
	var post = "";
	
	for (var i = 0; i < a.length; i++)
	{
		post += i+"="+a[i]+'&';
	}
	
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			fsend(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
			$('#load').hide();
			$('#messcontent').show();
		}else{
			$('#load').css('padding','300px').show();
			$('#messcontent').hide();
		}
	};
	
	xhr.open("POST", "./send", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(post);
}

function fsend(Qdata)
{
	$('#messcontent');
	var messT = $('#mess_text');
	if(Qdata == "1")
	{
		messT.html("<p>Ajout effectu&eacute; avec succ&egrave;s</p>");
		messT.attr('align', 'center').show();
		$('#message').attr('align','center').css('display','block');
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

function send_daff(a, b, c, d, e, f)
{
	// alert(f);
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			f1send(xhr.responseText); 
		}
	};
	
	xhr.open("POST", "./send_aff", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("1="+a+"&2="+b+"&3="+c+"&4="+d+"&5="+e+"&6="+f);
}

function f1send(aA)
{
	$('#messcontent');
	var messT = $('#mess_text');
	if(aA == "1")
	{
		messT.html("<p>Ajout effectu&eacute; avec succ&egrave;s</p>");
		messT.attr('align', 'center').show();
		$('#message').attr('align','center').css('display','block');
		$('#ex_mess').hide();
		window.setTimeout(function(){$('#message').fadeOut();} , 1500);
		window.setTimeout(function(){$('#form_insert').submit();} , 2000);
	}else
	{
		$('#mess_text').html(aA);
		$('#message').css('display','block');
		$('#ex_mess').show();
	}
}