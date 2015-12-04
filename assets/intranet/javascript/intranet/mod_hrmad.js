function send_mod(a, b, c, d, e, f)
{
	var xhr = getXMLHttpRequest();
	// var target = document.getElementById('tck_list').getElementsByTagName('tbody')[0];
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				$('#ex_mess').show();
				$('#mess_text').html(xhr.responseText);
		}else{
			$('#ex_mess').hide();
			$('#mess_text').html('<p>Envoi de la notification...</p><img src="'+$('#imgurl').val()+'24.gif'+'" />');
			$('#message').show();
		}
	};
	
	xhr.open("POST", "reservation/send_mod", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+a+"&1="+b+"&2="+c+"&3="+d+"&4="+e+"&5="+f);
}

function mod_hr(a, b, c, d, e, f, t)
{
	
	var xhr = getXMLHttpRequest();
	// var target = document.getElementById('tck_list').getElementsByTagName('tbody')[0];
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			mod_day_hr(xhr.responseXML, f, a);
		}
	};
	
	xhr.open("POST", "reservation/mod_heur_MAD", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+a+"&1="+b+"&2="+c+"&3="+d+"&4="+e);
}

function mod_day_hr(aData, aTarget, ts)
{
	aTarget.html("");
			
		var nodes = aData.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
		
		if(nodes.length == 0)
		{
			$(aTarget).html("<tr class='altcol'><td class='align_center' colspan='2'>Aucun formulaire enrégistré...</td></tr>");
		}else
		{
			var attrs = nodes[0].attributes;//Récupération du nobre d'attribut par ligne
			
			//---> Création des éléments du tableau
		
			var tDiv = document.createElement("div");
			var tr, td, inner;		
			var tab = [];
			
			var k = 1;
			//---> création des lignes du tableau
			for(var j=0; j<nodes.length; j++)
			{
				tr = document.createElement("tr");
				if((k % 2) != 0)
				{
					tr.setAttribute('class','altcol');
				}
				
				tr.setAttribute('sytle','display:none');
				tr.setAttribute('onclick','modifier(this)');
				if(nodes[j].attributes[0].nodeValue == ts)
				{
					tr.setAttribute('id','row_UTD');
				}
				for(var i=0; i<attrs.length; i++)
				{
					td = document.createElement("td");
					td.setAttribute('class','align_center');
					inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
					
					//alert(nodes[j].attributes[i].nodeValue);
					if((i == 0) || (i > 2))
					{
						td.setAttribute('style','display:none');
						td.appendChild(inner);
					}
					else
					{
						td.appendChild(inner);
					}
					tr.appendChild(td);
				}
				aTarget.append(tr);
				k++;
			}
			
			$('#row_UTD').trigger('click');	
			pagination('tck_list',10,'.navig_list_page','1');
			$('#ann').trigger('click');
		}
		
	
}
