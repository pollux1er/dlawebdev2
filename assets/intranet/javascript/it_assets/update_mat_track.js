function update_track(o0, o1, o2, o3, o4, o5, o6, o7, o8, o9, target, o10, o11, o12, o13) {
	if(o0)
	{
	
		// alert(o2);
		var xhr = getXMLHttpRequest();
	
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				upd_mat1(xhr.responseText, target, o1, o0, o5);
			}
		};
		
		xhr.open("POST", "materiel/ajax_updt_track" , true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("1="+o1+"&2="+o2+"&3="+o3+"&4="+o4+"&5="+o5+"&6="+o6+"&7="+o7+"&8="+o8+"&9="+o9+"&10="+o10+"&11="+o11+"&12="+o12+"&13="+o13);
	}	
}

function upd_mat1(oData, target, o1, o0, o5) {
	if(oData == '1')
	{
		$('#box_return').hide();
		$('#mess_text').html("<p>Nouveau mouvement enregistré </p>");
		$('#message').show();
		$('#ex_mess').hide();
		window.setTimeout(function(){ $('#message').hide()}, 1500);
		load_mat();
		ref_info();
		refresh_mat1(target, o1, o0);
		$('#date_return').val("");
	}else if(oData == '3'){
	
		$('#box_return').hide();
		$('#mess_text').html("<p>Mouvement modifié </p>");
		$('#message').show();
		$('#ex_mess').hide();
		window.setTimeout(function(){ $('#message').hide()}, 1500);
		load_mat();
		ref_info();
		refresh_mat1(target, o1, o0);
		$('#date_return').val("");
	}else {
		$('#box_return').hide();
		$('#mess_text').html(oData);
		$('#message').show();
		$('#ex_mess').show();
	}
	
	function refresh_mat1(target, o1, o0) {
		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				refresh1(xhr.responseXML, target, o1, o0);
			}
		};
		
		xhr.open("GET", "materiel/ajax_mat_refresh" , true);
		xhr.send(null);
	}
	
	function refresh1(data, oTarget, o1, o0)
	{
		var test = false;
		var test1 = false;
	
		$('#search select').each(function(){
			if(this.value != '')
			{
				test = true;
			}
			
		});

		$('#search input:text').each(function(){
			if(this.value != '')
			{
				test1 = true;
			}
		});
		
		if((test) || (test1))
		{
			search($('#numpomat').val(),  $('#serial').val(), $('#typemat').val(), $('#modemat').val(), $('#statmat').val(), $('#nomeqpt').val(), $('#sh_mat'));
		}else{
			$(oTarget).html("");
			
			var nodes = data.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
			
			if(nodes.length == 0)
			{
				$(oTarget).html("<tr class='altcol'><td class='align_center' colspan='2'>Auncun enregistrement trouv&eacute;...</td></tr>");
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
					if((k % 2) != 0)
					{
						tr.setAttribute('class','altcol cmd');
					}else{
						tr.setAttribute('class','cmd');
					}
					
					tr.setAttribute('name','row_cmd');
					tr.setAttribute('style','display:none;');
					tr.setAttribute('onclick','modifier_mat(this)');
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
			
			pagination('tck_list',5,'.navig_list_page','1');
		}
		show_track(o1, o0,$('#tab_hist'));
		$('#div_2 input:text, #div_2 select, #div_2 textarea').val('');	
	}
	// refresh_sn_nad();
}

