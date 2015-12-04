function glob(a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p)
{
	// alert(a+' '+b+' '+c+' '+d+' '+e+' '+f+' '+g+' '+h+' '+i+' '+j+' '+k+' '+l+' '+m+' '+n+' '+o);
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_mat(xhr.responseXML, o);
			$('#message').hide();
		}else if (xhr.readyState < 4) {
            $('#message').show();
			$('#load').css('padding','300px').show();
			$('#messcontent').hide();
        }
	};
	
	xhr.open("GET", "recherche/ajax_search_mat?1="+a+"&2="+b+"&3="+c+"&4="+d+"&5="+e+"&6="+f+"&7="+g+"&8="+h+"&9="+i+"&10="+j+"&11="+k+"&12="+l+"&13="+m+"&14="+n+"&15="+p , true);
	xhr.send(null);
}

function charger_mat(oData, oTarget)
{
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
				$('.caption_ticket').removeAttr('style');
				$('#tab_div').removeAttr('style');
				$('#empty').attr('style','display:none');
			
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
			pagination('tck_list',10,'.navig_list_page','1');
			
			
		
}

