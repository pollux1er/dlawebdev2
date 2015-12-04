$(function(){
	// $('#search select').change(function(){
		// search($('#numpo').val(), $('#dateliv').val(), $('#modele').val(), $('#type').val(), $('#Fournisseur').val(), $('#Statut').val(), $('#sh_cmd'));
	// });
	
	$('#filtre input:text').keyup(function(){
		search($('#numpo').val(), $('#dateliv').val(), $('#sh_cmd'));
	});
});

function search(o1, o2, target) {
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_comd1(xhr.responseXML, target);
		}
	};
	
	
	xhr.open("POST", "commande/ajax_search", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("1="+o1+"&2="+o2);
}

function charger_comd1(oData, oTarget) {
	// alert(oData);
	//-----------------> création du tableau d'affichage des détails:
		//---> récupération du code XML
			$(oTarget).html("");
			
			var nodes = oData.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
			//alert(nodes.length);
			
			if(nodes.length == 0)
			{
				$(oTarget).html("<tr class='altcol'><td class='align_center' colspan='2'>Pas de r&eacute;sultat pour cette recherche</td></tr>");
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
			}
			
		pagination('tck_list',10,'.navig_list_page','1');
}