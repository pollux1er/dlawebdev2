$(function(){
	$('#search select').change(function(){
		$('#zero').val('1');
		search($('#numpomat').val(), $('#serial').val(), $('#typemat').val(), $('#modemat').val(), $('#statmat').val(), $('#nomeqpt').val(), $('#sh_mat'));
	});
	
	$('#search input:text').keyup(function(){
		$('#zero').val('1');
		search($('#numpomat').val(),  $('#serial').val(), $('#typemat').val(), $('#modemat').val(), $('#statmat').val(), $('#nomeqpt').val(), $('#sh_mat'));
	});
});


function search(o1, o2, o3, o4, o5, o6, target) {
	var xhr = getXMLHttpRequest();
	
	// alert(o1+'  '+o2+'  '+o3+'  '+o4+'  '+o5+'  '+o6);
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_comd1(xhr.responseXML, target);
			$('#loader').css('visibility','hidden')
		} else if (xhr.readyState < 4) {
            $('#loader').css('visibility','visible')
        }
	};

	
	xhr.open("GET", "materiel/ajax_search_mat?1="+o1+"&2="+o2+"&3="+o3+"&4="+o4+"&5="+o5+"&6="+o6 , true);
	xhr.send(null);
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
				
				$(oTarget).html("<tr class='altcol'><td class='align_center' colspan='10'>Pas de r&eacute;sultat pour cette recherche</td></tr>");
			}else
			{
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
						tr.setAttribute('class','altcol cmd');
					}
					
					tr.setAttribute('name','row_cmd');
					tr.setAttribute('onclick','modifier_mat(this)');
					for(var i=0; i<attrs.length; i++)
					{
						td = document.createElement("td");
						td.setAttribute('class','align_center');
						inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
						//alert(nodes[j].attributes[i].nodeValue);
						if(i == 0)
						{
							inp = document.createElement('input');
							inp.setAttribute('type','hidden');
							inp.setAttribute('value',nodes[j].attributes[i].nodeValue)
							td.setAttribute('style','display:none');
							td.appendChild(inner);
							td.appendChild(inp);
						}
						else if (i == 10)
						{
							var a = document.createElement('a');
							a.setAttribute('href','#');
							a.setAttribute('onclick','details(\''+nodes[j].attributes[i].nodeValue+'\', $(\'#sh_dtl\')); return false;');
							a.appendChild(inner);
							td.appendChild(a);
						}
						else if (i == 8)
						{
							var val = nodes[j].attributes[i].nodeValue.split("-");
							
							b = document.createElement('div');
							b.setAttribute('align','left');
							b.setAttribute('class','div_del');
							
							c = document.createElement('img');
							c.setAttribute('src',$('#img_path').val()+val[1]);
							c.setAttribute('style','padding:0px; margin:0px;');
							
							b.appendChild(c);
							
							d = document.createTextNode(val[0]);
							
							td.appendChild(d);
							td.appendChild(b);
							
						}else
						{
							td.appendChild(inner);
						}
						tr.appendChild(td);
					}
					$(oTarget).append(tr);
					k++;
				}
				
				
			}
			var strong = $('[name=numb]');
			pagination('tck_list',5,'.navig_list_page',strong[0].innerHTML);
		
}