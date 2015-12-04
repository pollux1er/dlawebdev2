$('#val_typ').click(function(){
	add_1($('#add_typ').val());
	
});

function add_1(a)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			add1(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "commande/ajax_typ", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+a);
}

function add1(a)
{
	$('#mess_text').html(a);
	$('#message').css('display','block');
	$('#ex_mess').hide();
	
	window.setTimeout(function(){
		$('#message').fadeOut(); 
		$('[name=annuler_]').trigger('click');
		
	}, 2000);
	
	refresh_type($('#type_cmd'));
}

function refresh_type(target)
{
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			load_type(xhr.responseXML, target);
		}
	};
	
	xhr.open("GET", "commande/ajax_typ_refresh" , true);
	xhr.send(null);
}

	
function load_type(data1, cible)
{
	$(cible).html('<option value="" ></option> ');
	var nodes = data1.getElementsByTagName("item");
	for( var i =0; i < nodes.length; i++)
	{
		var opt = document.createElement('option');
		opt.setAttribute('value', nodes[i].attributes[0].nodeValue);
		var text = nodes[i].attributes[0].nodeValue;
		opt.appendChild( document.createTextNode(nodes[i].attributes[0].nodeValue) );
		if( text != ""){
			$(cible).append(opt);
		}
	}
}
	

//-----------------------------------------------------------------------------------//	
//                                                                                   //
//-----------------------------------------------------------------------------------//

$('#val_frn').click(function(){
	add_2($('#det_frn').val(), $('#nm_ctct').val(), $('#mail').val(), $('#tel_1').val(), $('#tel_2').val());
	
});

function add_2(a, b, c, d, e)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			add2(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "commande/ajax_frn", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+a+"&1="+b+"&2="+c+"&3="+d+"&4="+e);
}

function add2(a)
{
	$('#mess_text').html(a);
	$('#message').css('display','block');
	$('#ex_mess').hide();
	
	window.setTimeout(function(){
		$('#message').fadeOut(); 
		$('[name=annuler_]').trigger('click');
	}, 2000);
	
	refresh_frn($('#frn_det'));
}

function refresh_frn(target)
{
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			load_frn(xhr.responseXML, target);
		}
	};
	
	xhr.open("GET", "commande/ajax_frn_refresh" , true);
	xhr.send(null);
}

	
function load_frn(data1, cible)
{
	$(cible).html('<option value="" ></option> ');
	var nodes = data1.getElementsByTagName("item");
	for( var i =0; i < nodes.length; i++)
	{
		var opt = document.createElement('option');
		opt.setAttribute('value', nodes[i].attributes[0].nodeValue);
		var text = nodes[i].attributes[0].nodeValue;
		opt.appendChild( document.createTextNode(nodes[i].attributes[0].nodeValue) );
		if( text != ""){
			$(cible).append(opt);
		}
	}
}