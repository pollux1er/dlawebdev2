function update(o0, o1, o2, o3, o4, target) {
	if(o0)
	{
		var xhr = getXMLHttpRequest();
		// alert(o0);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				upd_mat(xhr.responseText, target, o1, o0, o2, o3);
			}
		};
		
		xhr.open("POST", "materiel/ajax_updt_mat" , true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("1="+o1+"&2="+o2+"&3="+o3+"&4="+o4);
	}
	
}

function upd_mat(oData, target, o1, o0, o2, o3) {
	// alert('update'+' '+o0);
	if(oData == '1')
	{
		$('#mess_text').html("<p>Identification effectuée</p>");
		$('#message').show()
		$('#ex_mess').hide()
		if((o2 != "") && (o3 != ""))
		{
			$('#2').show()
		}
		
		window.setTimeout(function(){ $('#message').hide()}, 1500);
		load_mat();
		ref_info();
		refresh_mat(target, o1, o0);
		
	}else if(oData != '2')
	{
		$('#mess_text').html(oData);
		$('#message').show();
		//$('#messcontent').show();
	}
	
	function refresh_mat(target, o1, o0) {
		// alert('refresh'+' '+o0);
		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				refresh(xhr.responseXML, target, o1, o0);
			}
		};
		
		xhr.open("GET", "materiel/ajax_mat_refresh" , true);
		xhr.send(null);
	}
	
	function refresh(data, oTarget, o1, o0)
	{
		//alert(data);
		var test = false;
		var test1 = false;
		// alert('input');
		$('#search select').each(function(){
			if(this.value != '')
			{
				test = true;
				// alert('select');
			}
			
		});

		$('#search input:text').each(function(){
			if(this.value != '')
			{
				test1 = true;
				// alert('input');
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
		show_track(o1, o0, $('#tab_hist'));
	}
	
	if($('#sn1').val() != '')
	{
		$('#div_2').show();
	}
	// function load_nommat(target)
	// {
		// var xhr = getXMLHttpRequest();
		// xhr.onreadystatechange = function() {
			// if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				// load_nom(xhr.responseXML, target);
			// }
		// };
		
		// xhr.open("GET", "materiel/ajax_nom_refresh" , true);
		// xhr.send(null);
	// }
	
	// function load_nom(data1, cible)
	// {
		// $(cible).html('<option value="" ></option> ');
		// var nodes = data1.getElementsByTagName("item");
		// for( var i =0; i < nodes.length; i++)
		// {
			// var opt = document.createElement('option');
			// opt.setAttribute('value', nodes[i].attributes[0].nodeValue);
			// var text = nodes[i].attributes[0].nodeValue;
			// opt.appendChild( document.createTextNode(nodes[i].attributes[0].nodeValue) );
			// if( text != ""){
				// $(cible).append(opt);
				// alert('eeer');
			// }
		// }
	// }
	
	// load_nommat($('#nomeqpt'));
	// refresh_sn_nad();
}

