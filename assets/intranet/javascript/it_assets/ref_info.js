function ref_info() {
	// alert('');
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			ref(xhr.responseXML);
		}
	};
	
	xhr.open("GET",'materiel/refresh_info', true);
	xhr.send(null);
}

function ref(data){
	// alert(data);
	$('#sn_body').html("");
	
	var nodes = data.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
	
	if(nodes.length == 0)
	{
		$('#sn_body').html("<tr class='altcol'><td class='align_center' colspan='2'>Auncun enregistrement trouv&eacute;...</td></tr>");
	}else{
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
			tr.setAttribute('id',k);
			for(var i=0; i<attrs.length; i++)
			{
				td = document.createElement("td");
				td.setAttribute('class','align_center');
				inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
				if(i == 0)
				{
					inp = document.createElement('input');
					inp.setAttribute('type','hidden');
					inp.setAttribute('value',nodes[j].attributes[i].nodeValue)
					td.setAttribute('style','display:none');
					td.appendChild(inner);
					// td.appendChild(inp);
				}
				else
				{
					if(i == 1)
					{
						td.setAttribute('class','label align_center');
						td.appendChild(inner);
					}else if(i == 4)
					{
						var b = document.createElement('b');
						b.setAttribute('style','font-size:12pt;');
						b.appendChild(inner);
						td.appendChild(b);
					}else{
						td.appendChild(inner);
					}
					
				}
				tr.appendChild(td);
			}
			k++;
			
			var td4 = document.createElement('td');
			td4.setAttribute('class','align_center');
			
			var a = document.createElement('input');
			a.setAttribute('id','fichier');
			a.setAttribute('type','file');
			a.setAttribute('class','input_type input_criteria');
			a.setAttribute('size','50');
			a.setAttribute('maxlength','100000');
			a.setAttribute('accept','text/*');
			td4.appendChild(a);
			tr.appendChild(td4)
			
			var td5 = document.createElement('td');
			td5.setAttribute('class','align_center');
			
			b = document.createElement('input');
			b.setAttribute('type','button');
			b.setAttribute('class','tpl_button_neutral');
			b.setAttribute('value','Charger');
			b.setAttribute('onclick','charger_sn(this);');
			
			td5.appendChild(b);
			tr.appendChild(td5);
			
			$(sn_body).append(tr);
		}
	}
}