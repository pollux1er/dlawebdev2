$(function(){
	$('#val_cmd').click(function(){
		$('#messcontent').show();
		if($('#val_cmd').val() == "Valider")
		{
			$('#term_dtl').hide();
		}
		$('#ann_dtl_cmd').show();
		$('#supp_dtl').hide();
		valider_cmds($('#idcom').val(), $('#numpo1').val(), $('#dateliv1').val(), $('#val_cmd').val(), $('#sh_cmd'));
	});
	
	$('#val_dtl').click(function(){
		
		var val = "";
		if( typeof($('#add_mark1').val())!='undefined')
		{
			if($('#add_mark1').val() == "")
			{
				val = $('#dtl_prdt').val();
			}else{
				val = $('#add_mark1').val();
			}
		}else{
			// alert('rrrr');
			val = $('#dtl_prdt').val();
		}
		
		// var lien = $('#fichier').val();
		// var cut = lien.split('fakepath\\');
		// lien = cut[0]+'import\\'+cut[1];
		valider_dtls($('#det_po').val(), $('#iddet_cmd').val(), $('#type_cmd').val(),  val, $('#dtl_qte').val(), $('#frn_det').val(), $('#val_dtl').val(), $('#visio_dtl'), /*lien,*/ $('#prop').val());
	});
});

//fonction d'enregistrement de la commande et appel de la fonction d'neregistrement des details de la commande
function valider_cmds(o0, o1, o2, o3, target) {
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_comd2(xhr.responseText, target, o1); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "commande/ajax_check", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+o0+"&1="+o1+"&2="+o2+"&3="+o3);

}

function charger_comd2(dData, vTarget, a)
{
	//alert(dData)
	if(dData == "1")
	{
		$('#lb_dtl').html('Saisie d&eacute;tail du PO N. '+a);
		$('#det_po').val(a);
		$('#det_comd').css('display','block');
		$('#ex_mess').hide();
		$('#ex_dtl').hide();
		$('#val_dtl').val('Ajouter');
		
	}else if (dData == "2")
	{
	
		$('#mess_text').html("<p>Modification effectu&eacute;e avec succ&egrave;s</p>");
		$('#message').css('display','block');
		$('#ex_mess').show();
		details(a, $('#sh_dtl'));
		$('#idcomd').val("asc");
		$('#a_idcomd').trigger('click');
		
		var i = 1;
		var trs = document.getElementById('sh_cmd').getElementsByTagName('tr');
		
		for(var j = 0; i < trs.length-1; j++)
		{
			if( (i-1)%10 == 0 )
			{
				pagination('tck_list', 10, 'div.navig_list_page', i);
			}
			
			var as = trs[j].getElementsByTagName('td')[1].getElementsByTagName('a')[0];
			if($(as).text() == a)
			{
				$(as).trigger('click');
				break;
			}
		}
		
	}
	else{
		$('#mess_text').html(dData);
		$('#message').css('display','block');
		$('#ex_mess').show();
	}	
} // fin de fonction


//fonction d'enregistrement des détails de la commande et appel de la fonction de chargement du tableau des détails commande du script "detail_cmd.js"
function valider_dtls(o0, o1, o2, o3, o4, o5, o6, target, /*o7,*/ o8)
{
	// alert(o7)
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_comd3(xhr.responseText, target, o0);
			$('#img_load').hide();
		}else if (xhr.readyState < 4) {
			$('#img_load').show();
		}
	};
	
	xhr.open("POST", "commande/ajax_check_dtl", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+o0+"&1="+o1+"&2="+o2+"&3="+o3+"&4="+o4+"&5="+o5+"&6="+o6+"&8="+o8);
}

function charger_comd3(dData, vTarget, o0)
{
	//alert(dData);
	if(dData == "1")
	{
		//$('#det_comd').css('display','block');
		$('#er_visio').html("");
		$('#er_visio').html("<p>Enregistement effectu&eacute; avec succ&egrave;s</p>");
		$('#dtl_content input:text, #dtl_content select').val("");
		
		charger_dtls(vTarget, o0);
		
		
	}else if (dData == "2")
	{
		$('#er_visio').html("<p>Modification effectu&eacute;e avec succ&egrave;s</p>");
		details(o0, $('#sh_dtl'));
		$('#tab_saisie_det input:text, #tab_saisie_det select').each(function(){
			//alert('ge')
			$(this).val("");
		})
	}else if(dData == "3")
	{
		$('#er_visio').html("<p>Ajout effectu&eacute; avec succ&egrave;s</p>");
		
		if(document.getElementById('dtl_prdt').tagName == "INPUT")
		{
			var parent = $('#dtl_prdt').parent();
			$('#dtl_prdt').remove();
			$(parent).html('<select id="dtl_prdt" name="dtl_prdt" class="input_type input_criteria"></select><input id="add_marque" type="button" value="New" class="tpl_button_insert" style="cursor:normal; margin-left:10px;" onclick="add_mark(this);"><input id="add_mark1" type="text" value="" class="input_type input_criteria" style="cursor:normal; display:none;"><input id="ann_mark" type="button" value="Annuler" class="button_action_ann" style="cursor:normal; margin-left:10px; display:none;">');
		}
		
		refresh_mark($('#dtl_prdt'));
		details(o0, $('#sh_dtl'));
		$('#term_dtl').show();
		$('#tab_saisie_det input:text, #tab_saisie_det select').each(function(){
			$(this).val("");
		})
		$('#ann_mark').trigger('click');
	}else
	{
		$('#er_visio').html(dData);
		//$('#message').css('display','block');
	}	
	
	
} // fin de fonction



function charger_dtls(trg, oO)
{
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			list_dts(xhr.responseXML, trg);
		}
	};
	
	xhr.open("GET", "commande/ajax_det_com?numeropo="+oO, true);
	//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(null);
}

function list_dts(data, trg)
{
	//alert(data+' - '+trg)
	var nodes = data.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
			$(trg).html("");
			if(nodes.length > 0)
			{
				$("#term_dtl").show();
			}
			
			var attrs = nodes[0].attributes;//Récupération du nobre d'attribut par ligne
			
		//---> Création des éléments du tableau
		
			var br = document.createElement('br');
			var table = document.createElement("table");
			var tete = document.createElement("thead");
			var corps = document.createElement("tbody");
			var lgn = document.createElement("tr");
			
			var th, tr, inner, Dinner;
		
			var tab = [];
			
		//---> définition des noms des en-tête de tableau
			tab[0] = "N°"; tab[1] = "Marque / madèle"; tab[2] = "Quantite"; tab[3] = "Type"; tab[5] = "Fournisseur";
	
			//---> création de l'en-tête
			for(var i=0; i<attrs.length; i++)
			{
				th = document.createElement("th");
				inner = document.createTextNode(tab[i]);
				th.appendChild(inner);//injection du texte dans le th
				lgn.appendChild(th);//injection des th dans la ligne (tr)
			}
			
			tete.appendChild(lgn);//injection de la ligne dans le thead
			table.setAttribute('class','ticket_list');
			table.appendChild(tete);//injection du thead dans la table
			
			var k = 1;
			//---> création des lignes du tableau
			for(var j=0; j<nodes.length; j++)
			{	
				
				tr = document.createElement("tr");
				if((k % 2) != 0)
				{
					tr.setAttribute('class','altcol');
				}
				
				for(var i=0; i<attrs.length; i++)
				{
					td = document.createElement("td");
					td.setAttribute('class','align_center');
					if (i==0)
					{
						inner = document.createTextNode(j+1);
					}else{
						inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
					}
					
					td.appendChild(inner);
					tr.appendChild(td);
				}
				corps.appendChild(tr);
				k++;
			}
			
			table.appendChild(corps);//injection du tbody dans la table
			$(trg).append(br);
			$(trg).append(table);//insertion de tout le div dans la cible
			$(trg).append(br);
			$(trg).css('display','inline-block');
			
			// var a = document.getElementById('dtl_prdt');
			// if(a.tagName == "INPUT")
			// {
				
			// }
}

function refresh_mark(aM)
{
		var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			load_mark(xhr.responseXML, aM);
		}
	};
	
	xhr.open("GET", "commande/ajax_mrk_refresh" , true);
	xhr.send(null);
}

function load_mark(mark_data, mark_cible)
{
	$(mark_cible).html('<option value="" ></option> ');
	var nodes = mark_data.getElementsByTagName("item");
	for( var i =0; i < nodes.length; i++)
	{
		var opt = document.createElement('option');
		opt.setAttribute('value', nodes[i].attributes[0].nodeValue);
		var text = nodes[i].attributes[0].nodeValue;
		opt.appendChild( document.createTextNode(nodes[i].attributes[0].nodeValue) );
		if( text != ""){
			$(mark_cible).append(opt);
			// alert('eeer');
		}
	}
}
