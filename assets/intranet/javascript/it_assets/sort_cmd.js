function sort_cmde(moi, sort, order, target) {
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_comd(moi, xhr.responseXML, target, order);
		}
	};
	
	//xhr.open("GET", "det_com?numeropo=" + numeropo, true);
	//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//xhr.send(null);
	//alert(moi+' - '+sort+' - '+order)
	
	xhr.open("GET", "commande/ajax_sort?sort="+sort+"&order="+order , true);
	xhr.send(null);
}

function charger_comd(me, oData, oTarget, oOrder) {
	//alert(oData);
	//$(target).append("<p>Je suis en pause</p>");
	//as = $('#tck_list td a').length
	
	//-----------------> création du tableau d'affichage des détails:
		//---> récupération du code XML
			$(oTarget).html("");
			
			var nodes = oData.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
			
			if(nodes.length == 0)
			{
				$(oTarget).html("<tr class='altcol'><td class='align_center' colspan='2'>Auncun enregistrement trouv&eacute;...</td></tr>");
			}else{
				var attrs = nodes[0].attributes;//Récupération du nobre d'attribut par ligne
				//alert(attrs.length);
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
					
					tr.setAttribute('onclick','modifier_cmd(this)');
					for(var i=0; i<attrs.length; i++)
					{
						td = document.createElement("td");
						td.setAttribute('class','align_center');
						inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
						//alert(nodes[j].attributes[i].nodeValue);
						if(i == 0)
						{
							td.setAttribute('style','display:none');
							td.appendChild(inner);
						}
						else if (i == 1)
						{
							var a = document.createElement('a');
							a.setAttribute('href','#');
							a.setAttribute('onclick','details(\''+nodes[j].attributes[i].nodeValue+'\', $(\'#sh_dtl\')); return false;');
							a.appendChild(inner);
							td.appendChild(a);
						}
						else
						{
							td.appendChild(inner);
						}
						tr.appendChild(td);
					}
					$(oTarget).append(tr);
					k++;
				}
			
				//swicth de 'asc' à 'desc' et inversement selon la valeur première de oOrder
				if(oOrder == 'asc')
				{
					//alert('1 - '+oOrder)
					$(me).val('desc');
				}
				else
				{
					//alert('2 - '+oOrder)
					$(me).val('asc');
				}
			}
			
			
			//alert($(me).val())
			pagination('tck_list',10,'.navig_list_page','1');
			load_po();
}