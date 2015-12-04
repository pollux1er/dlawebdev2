$("#deploiement select").each(function(){
	$(this).change(function(){
		sort_deploy($("#affich1").val(), $("#affich2").val(), $("#affich3").val(), $('#sh'));
	});
});

function sort_deploy(o0, o1, o2, target) {
	// alert(o0+ o1+ o2+ target);
	// if(o0 && o1 && o2 && target)
	// {
		var xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				upd_mat(xhr.responseXML, target);
			}
		};
		
		xhr.open("POST", "ajax_sort_dep" , true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("1="+o0+"&2="+o1+"&3="+o2);
	// }
	
}

function upd_mat(data, oTarget)
{
	// alert(data);
	$(oTarget).html("");
			
	var nodes = data.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
	
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
		
		var k = 0;
		//---> création des lignes du tableau
		for(var j=0; j<nodes.length; j++)
		{
			tr = document.createElement("tr");
			if((k % 2) != 0)
			{
				tr.setAttribute('class','altcol cmd');
			}else{
				tr.setAttribute('class','cmd');
			}
			
			tr.setAttribute('name','row_cmd');
			tr.setAttribute('onclick','modifier_mat(this)');
			for(var i=0; i<attrs.length; i++)
			{
				td = document.createElement("td");
				td.setAttribute('class','align_center');
				inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
				//alert(nodes[j].attributes[i].nodeValue);
				if((i == 0) || (i == 1) || (i == 9) || (i == 12))
				{
					inp = document.createElement('input');
					inp.setAttribute('type','hidden');
					inp.setAttribute('value',nodes[j].attributes[i].nodeValue)
					td.setAttribute('style','display:none');
					td.appendChild(inner);
					td.appendChild(inp);
				}
				else if (i == 7)
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
					
					td.setAttribute('style','font-weight:normal');
					td.appendChild(d);
					td.appendChild(b);
					
				}else
				{
					td.setAttribute('style','font-weight:normal');
					td.appendChild(inner);
				}
				tr.appendChild(td);
			}
			$(oTarget).append(tr);
			k++;
		}
	}
	
	pagination('tck_list',15,'.navig_list_page','1');
}