	function load_rw( data, Ac )
	{
		var nodes = data.getElementsByTagName('item');
		
		var content = [];
		if( nodes.length != 0 )
		{
			var ind_id = nodes[0].attributes[0].value;
			$('#id1').val(ind_id);
			for( var i = 0 ; i < nodes.length ; i++ )
			{
				content.push('<tr class="altcol" onclick="modifier(this)" >');
				var tds = nodes[i].attributes;
				for ( var j = 0; j < tds.length; j++ )
				{
					content.push('<td align="center" ');
					if( (j == 0) )
					{
						content.push(' style="display:none" ');
					}
					
					content.push('>'+(tds[j].nodeValue)+'</td>');
				}
				
				content.push('</tr>')
			}
			
			var cont = content.join("");
			content = null;		
			
			$(Ac).html( cont );
			if( $('#cars').length == 0 )
			{
				$(Ac.getElementsByTagName('tr')[0]).trigger('click');
			}
		} else {
			content.push('<tr class="" ><td colspan="7" align="center"> Aucun enregistrement </td></tr>');
			
			var cont = content.join("");
			content = null;	
			$(Ac).html( cont );
		}
	}
	
	function post_els( id, limit, b )
	{
		// reintialisation à 0 des elts de recherche.
		$('#r_immat').val( "" );
		$('#r_mrk').val( "" );
		$('#r_type').val( "" );
		$('#r_stat').val( "" );
		$('#r_pp').val( "" );
		
		var param = [
						{ "name":"id", value: id },
						{ "name":"limit", value: limit },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() }
					]
					
		$.post('vehicule/refresh_veh', param, function(data) {
			if (data) {
				
				var target = document.getElementById('showf');
				load_rw( data, target);
				
				var line = data.getElementsByTagName('line')[0];
				var nblin = parseInt(line.attributes[0].nodeValue);
				// alert(nblin);
				if( (b == "yes") && ( $('#cars').length == 0 ) )
				{ 
					$(target.getElementsByTagName('tr')[nblin]).trigger('click');
				}
				
				var tr_id = target.getElementsByTagName('tr')[nblin].getElementsByTagName('td')[0].innerHTML;
				$('#id').val(trim(tr_id));
				
				var nbr = data.getElementsByTagName('nbre')[0];
				$('#num_rows').val(nbr.attributes[0].nodeValue);
				
				var stp = data.getElementsByTagName('step')[0];
				$('#step').val(stp.attributes[0].nodeValue);
				
				$('.navig_nb_record').html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
				
				var nom = $('#module').val();
				var _nom = "";
				var end = 0; 
				if(nom[nom.length-1] == 's')
				{
					end = nom.length-1;
				}else{
					end = nom.length;
				}

				for( var i = 0; i < end; i++ )
				{
					_nom += nom[i];
				}
				
				var nav_target = document.getElementById('page_1');
				var limit = parseInt($('#limit').val());
				var step = parseInt(stp.attributes[0].nodeValue);
				var num = parseInt(nbr.attributes[0].nodeValue);
				// alert( "limit : "+limit+" step : "+step+" num : "+num );
				$(nav_target).html("");
				
				load_range(nav_target, limit, step, num, _nom.toLowerCase());
			}
		}, "xml");
	}
	
	var message = $('#message');
	var txt_m = $('#mess_text');
	$('#messcontent').css('position','absolute');

	function cr_pop( data )
	{
		var msg = data.split('@');
		
		var pop = $('#pop');
		if( pop.length == 0 )
		{
			// $('#messcontent').attr('align','center');
			$('#messcontent').append('<div id="pop" style="background-color:white;"></div>');
			$('#pop').append(msg[0]);
		}else{
			$('#pop').html('');
			$('#pop').append(msg[0]);
			$('#pop').fadeIn();
		}
		
		window.setTimeout(function(){ $('#pop').fadeOut() }, 2000);
		
		if( msg[1] == "OK" )
		{
			post_els( msg[2], msg[3], "yes" );
			window.setTimeout(function(){ $('#ex_mess').click() }, 2000);
		}
	}

	function call_visu()
	{
		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				t_call_visu(xhr.responseXML);
			}
		};
		
		xhr.open("POST", "vehicule/all", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(null);
	}

	function t_call_visu(aData)
	{
		$('#sh').html("");
		
		var nodes = aData.getElementsByTagName("cars");
		var nodes1 = aData.getElementsByTagName("typmod");
		var nodes2 = aData.getElementsByTagName("stat");
		var nodes3 = aData.getElementsByTagName("att");
		
		var content = [];
		
		content.push('<div class="title"> Etat du Parc Automobile </div><br><div  style="overflow-y:scroll; overflow-x:hidden; width:100%; max-height:700px;">');
		content.push('<table id="cars" style="width:99%"><tr><th colspan="" style="padding-left:10px;" align="left"> Nombre de voitures : ');
		content.push(nodes[0].attributes[0].nodeValue+'</th></tr></table><br>');
		
		content.push('<table style="width:99%"><colgroup><col width="33%"><col width="33%"><col width="33%"></colgroup>');
		content.push('<tr><th colspan="3" style="padding-left:10px;" align="center"> Type - modèle </th></tr>');
		content.push('<tr><th align="center"> Type </th><th align="center"> Modèle </th><th align="center"> Quantité </th></tr>');
			var attrs = nodes1[0].attributes;
			for(var i = 0; i<nodes1.length; i++)
			{
				content.push('<tr class="altcol">');
				for(var j = 0; j<attrs.length; j++)
				{
					content.push('<td align="center" style="border:1px solid black; line-height:20px;">'+nodes1[i].attributes[j].nodeValue+'</td>');
				}
				content.push('</tr>');
			}
		content.push('</table><br>');
		
		content.push('<table style="width:99%"><colgroup><col width="50%"><col width="50%"></colgroup>');
		content.push('<tr><th colspan="2" style="padding-left:10px;" align="center"> Bilan Check </th></tr>');
		content.push('<tr><th align="center"> Etat </th><th align="center"> Quantité </th></tr>');
			var attrs1 = nodes2[0].attributes;
			for(var i = 0; i<nodes2.length; i++)
			{
				content.push('<tr class="altcol">');
				for(var j = 0; j<attrs1.length; j++)
				{
					content.push('<td align="center" style="border:1px solid black; line-height:20px;">'+nodes2[i].attributes[j].nodeValue+'</td>');
				}
				content.push('</tr>');
			}
		content.push('</table><br>');
		
		content.push('<table style="width:99%"><colgroup><col width="50%"><col width="50%"></colgroup>');
		content.push('<tr><th colspan="2" style="padding-left:10px;" align="center"> Statut véhicule (OK) </th></tr>');
		content.push('<tr><th align="center"> Statut </th><th align="center"> Quantité </th></tr>');
			var attrs2 = nodes3[0].attributes;
			for(var i = 0; i<nodes3.length; i++)
			{
				content.push('<tr class="altcol">');
				for(var j = 0; j<attrs2.length; j++)
				{
					content.push('<td align="center" style="border:1px solid black; line-height:20px;">'+nodes3[i].attributes[j].nodeValue+'</td>');
				}
				content.push('</tr>');
			}
		content.push('</table><br>');
		
		content.push('</div>');
		var visu_cont = content.join("");
		
		$('#sh').append(visu_cont);
	}
	
	if($('#id1').val() == "")
	{
		call_visu();
	}
	
	function modifier(aA)
	{
		// alert(1);
		line_color(aA, 'tck_list');
		//Modification de la parte visu de module
			//--> Info sur vévicule
			$('#sh').html("");
			var content = [];
			content.push("<div class='title'> Infos Véhicules </div>");
			
			var visu_content = content.join("");
			content = null;
			
			$('#sh').html(visu_content);
			
			var td0 = trim(aA.getElementsByTagName('td')[0].innerHTML);
			$('#id').val(td0);
			
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					t_one_visu(xhr.responseXML,aA);
				}
			};
			
			xhr.open("POST", "vehicule/one", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("0="+td0);
			
			function t_one_visu(aData,aB)
			{ 
				if( $('#fd_stat').length != 0 )
				{
					$('#fd_stat').remove();
				}
				
				var content = [];
				var fct = "";
				var check = false;
				if (aData.getElementsByTagName("item").length != 0)
				{
					var nodes = aData.getElementsByTagName("item");
					var label1 = new Array("Demandeur","Chauffeur","Trajet","Lieu","Date départ","Date Arrivée");
					fct = "Réservation";
					check = true;
				}else {
					content.push("<fieldset id='fd_stat' align='left' style='padding:3px; margin:3px; border:none; border-top:1px solid #6699CC;'>");
					content.push("<legend style='margin:5px; padding:0 5px 0 5px; font-weight:bold; font-size:12pt; color:#003388;' >");
					
					if ( aData.getElementsByTagName("intel").length != 0 )
					{						
						content.push("Statut Véhicule </legend><p align='center' style='font-size:10pt; font-weight:bold;'><b> "+aData.getElementsByTagName("intel")[0].attributes[0].nodeValue+" <b></p>");
					}else{
						content.push("Statut Véhicule </legend><p align='center' style='font-size:10pt; font-weight:bold;'><b> Statut du Véhicule : Disponible <b></p>");
					}
				}
				
				if( check == true ) 
				{
					var tds = aB.getElementsByTagName('td');
					var attr = nodes[0].attributes;
					
					content.push("<fieldset id='fd_stat' align='left' style='padding:3px; margin:3px; border:none; border-top:1px solid #6699CC;'>");
					content.push("<legend style='margin:5px; padding:0 5px 0 5px; font-weight:bold; font-size:12pt; color:#003388;' >");
					content.push("Statut Véhicule </legend><div align=\"center\">");
					content.push("<table id='tab_visu' class='form' style='width:90%' align='center'><colgroup><col width ='35%'><col width='65%'></colgroup>");
					content.push("<tr><th colspan='2'>"+fct+"</th></tr>");
					
					for( var i = 0; i < attr.length; i++ )
					{
						content.push("<tr><td class='label' align='right' style='height:25px;'>"+label1[i]+"</td><td style='padding-left:10px;'>"+nodes[0].attributes[i].nodeValue+"</td></tr>")
					}
					content.push("</table></div>");
					
				}
				
				content.push("<br><div><input id='mod' value='Modifier' type='button' class='button_action_ann button_action_mod'>&nbsp;&nbsp;&nbsp;");
				content.push("<input id='infg' type='button' class='button_action_ann button_action_back' value='Info Globale'>");
				
				var hide = "disabled";
				if( check == false )
				{
					hide = "";
					content.push("&nbsp;&nbsp;&nbsp;<input id='sup' type='button' class='tpl_button_delete' value='Supprimer'></div>");
				}							
				content.push("</fieldset>");
				
				var in_cont = content.join("");
				content = null;
				$('#sh').append(in_cont);
				
				$('#mod').click( function(){ call_form("Modifier", aB, hide); });
				$('#infg').click( function(){ call_visu(); });
				
				$('#sup').click( function(){
					var check = confirm('Cette action aura pour effet de supprimer définitivement ce véhicule du parc... Etes vous sûr de vouloir continuer?');
					if( check == true )
					{
						var pid =trim(aB.getElementsByTagName('td')[0].innerHTML);
						var param = [ 
										{ "name":"pid", value: pid},
										{ "name":"step", value: parseInt( $('#step').val()) },
										{ "name":"limit", value: parseInt($('#limit').val()) },
										{ "name":"sort", value: $('#sort').val() },
										{ "name":"order", value: $('#order').val() }
									];
						$.post('vehicule/supp_veh', param, function(data) 
						{
							if (data) {
								// alert(data);
								// var msg = data.split('@');
								// txt_m.html("");
								// txt_m.append( msg[0] );
								// message.show();
								
								// if( msg[1] == 'OK' )
								// {
									// window.setTimeout(function(){ location.reload() }, 3000);
								// }
								
								var target = document.getElementById('showf');
								load_rw( data, target );
								
								// var line = data.getElementsByTagName('line')[0];
								// var nblin = parseInt(line.attributes[0].nodeValue);
								// alert(nblin);
								// $(target.getElementsByTagName('tr')[nblin]).trigger('click');
								
								var nbr = data.getElementsByTagName('nbre')[0];
								$('#num_rows').val(nbr.attributes[0].nodeValue);
								
								var stp = data.getElementsByTagName('step')[0];
								$('#step').val(stp.attributes[0].nodeValue);
								
								$('.navig_nb_record').html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
								
								var nom = $('#module').val();
								var _nom = "";
								var end = 0; 
								if(nom[nom.length-1] == 's')
								{
									end = nom.length-1;
								}else{
									end = nom.length;
								}

								for( var i = 0; i < end; i++ )
								{
									_nom += nom[i];
								}
								
								var nav_target = document.getElementById('page_1');
								var limit = parseInt($('#limit').val());
								var step = parseInt(stp.attributes[0].nodeValue);
								var num = parseInt(nbr.attributes[0].nodeValue);
								// alert( "limit : "+limit+" step : "+step+" num : "+num );
								$(nav_target).html("");
								
								load_range(nav_target, limit, step, num, _nom.toLowerCase());
								
								var mess = data.getElementsByTagName('message')[0].attributes[0].nodeValue;
								$('#mess_text').html('<p>'+mess+'</p>');
								$('#message').show();
								window.setTimeout(function(){ $('#message').hide(); }, 1500);
							}
						}, "xml");
					}
					

				});
			}
	}
	
	$('#add').click(function(){ call_form("Valider", "", "") });
				
	function call_form(act, a, b){
		
		txt_m.html("");
		if($('#pop').length != 0)
		{
			$('#pop').hide();
		}
		message.show();
		var content = [];
		var chg = "";
		if( act == "Modifier" )
		{
			chg = "Modification";
		}else{
			chg = "Ajout nouveau";
		}
		
		content.push('<div class="title"> '+chg+' véhicule </div>');
		content.push('<div style="background-color:#ffffff; padding-top:10px; padding-bottom:10px; width:500px;"><table id="tab_ch" style="margin:10px; border: 1px solid lightgray; width:90%">');
		
		if( act == "Modifier" )
		{
			content.push('<tr style="display:none;"><td style="padding:10px;"></td><td align="left"><input id="pid" type="text" class="input_type"/></td></tr>');
		}
		
		content.push('<tr><td align="left" style="padding:10px;"><b> Immatriculation (*) : </b></td><td align="left"><input id="immat" type="text" class="input_type" /></td></tr>');
		content.push('<tr><td align="left" style="padding:10px;"><b> Kilometrage (*) : </b></td><td align="left"><input id="kilo" type="text" class="input_type" onkeyup="check_int(this);" /></td></tr>');
		content.push('<tr><td align="left" style="padding:10px;"><b> Marque - Modèle (*) : </b></td><td align="left"><input id="markmod" type="text" class="input_type" /></td></tr>');
		content.push('<tr><td align="left" style="padding:10px;"><b> Type (*) : </b></td><td align="left"><select id="type" class="input_type">');
			content.push('<option value=""></option>');
			
			if( $('#ar_typ').length != 0 )
			{
				var typ = $('#ar_typ').val().split("@@");
				
				for( var i = 0; i < typ.length; i++)
				{
					var t = typ[i].split('@');
					content.push('<option value="'+t[1]+'">'+t[1]+'</option>');
				}
			}
			
		content.push('</select><img id="new" src="'+$('#imgurl').val()+'new-text.png" style="padding-left:10px; vertical-align:middle;" /></td></tr>');
		
		if( act == "Modifier" )
		{
			content.push('<tr><td align="left" style="padding:10px;"><b> Statut (*) : </b></td><td align="left"><select id="stat" class="input_type" '+b+' >');
				content.push('<option value=""></option>');
				
				if( $('#ar_typ').length != 0 )
				{
					var stats = $('#ar_st').val().split("@@");
					
					for( var i = 0; i < stats.length; i++)
					{
						var t = stats[i].split('@');
						content.push('<option value="'+t[1]+'">'+t[1]+'</option>');
					}
				}
			
			content.push('</select></td></tr>');
		}
		
		content.push('<tr><td align="left" style="padding:10px;"><b> Prochaine vidange (*) : </b></td><td align="left"><input id="pv" type="text" class="input_type" '+b+' onkeyup="check_int(this)"/></td></tr>');
		content.push('<tr><td align="left" style="padding:10px;"><b> Propriétaire : </b></td><td align="left"><input id="prop" type="text" class="input_type" value="Perenco"/></td></tr>');
		content.push('</table><br>');
		content.push('<input id="val" type="button" class="tpl_button_insert" value="'+act+'" />&nbsp;&nbsp;&nbsp;<input id="ann" type="button" class="button_action_ann" value="Annuler" /><br>')
		content.push('<div  style="height:50px; visibility:visible;background-color:white;"><div id="mess_res" style="overflow:hidden; display:none;"><p>Veuillez changer le statut de la réservation avant de valider...</p></div></div>');
		content.push('</div>');
		var add_cont = content.join("");
		
		txt_m.append(add_cont);
		
		$('#new').click(function(){
			if( $('#ttype').length == 0 )
			{
				$('#new').after("<input id='ttype' type='text' class='input_type'/><img id=\"back\" src='"+$('#imgurl').val()+"undo_16.png' style='padding-left:10px; vertical-align:middle;' />");
			}else{
				$('#ttype').show();
				$('#back').show();
			}
			$('#type').val("");
			$('#type').hide();
			$(this).hide();
			$('#back').click(function(){
				$('#type').show();
				$('#new').show();
				$('#ttype').val("");
				$('#ttype').hide();
				$(this).hide();
			});
		});
			
		$('#ann').click(function(){
			$('#ex_mess').trigger('click');
		});
		
		if( act == "Modifier" )
		{
			var tds = a.getElementsByTagName('td');
			var table = $("#tab_ch"); 
			var inps = $("#tab_ch input");
			var sels = $("#tab_ch select");
			var j = 0;
			var k = 0;
			
			for (var i = 0; i < tds.length; i++)
			{
				if( (i < 4) || (i > 5) )
				{
					inps[j].value = trim(tds[i].innerHTML);
					j++;
				}else{
					$(sels[k]).val(trim(tds[i].innerHTML));
					k++;
				}
			}
			
		}
		
		$('#val').click(function(){
			var typ = "";
			var stat = "";
			var pid = "";
			
			if( parseInt( $('#kilo').val() ) == 0 )
			{
				var pop = $('#pop');
				if( pop.length == 0 )
				{
					// $('#messcontent').attr('align','center');
					$('#messcontent').append('<div id="pop" style="background-color:white;"></div>');
					
				}else{
					$('#pop').html('');
					$('#pop').fadeIn();
				}
				
				$('#pop').append("<p>Le kilométrage de ce véhicule doit être supérieur à 0</p>");
				
				window.setTimeout(function(){ $('#pop').fadeOut() }, 4000);
				
				return false;
			}
			
			if( parseInt( $('#pv').val() ) == 0 )
			{
				var pop = $('#pop');
				if( pop.length == 0 )
				{
					// $('#messcontent').attr('align','center');
					$('#messcontent').append('<div id="pop" style="background-color:white;"></div>');
				}else{
					$('#pop').html('');
					$('#pop').fadeIn();
				}
				
				$('#pop').append("<p>La valeur de la prochaine vidange de ce véhicule doit être supérieur à 0</p>");
				
				window.setTimeout(function(){ $('#pop').fadeOut() }, 4000);
				
				return false;
			}
			
			if( act == "Valider" )
			{
				stat = "OK";
			}else{
				pid = $('#pid').val();
				stat = $('#stat').val();
			}
			
			if( $('#type').val() == "" ){
				if( ($('#ttype').length != 0)  &&  $('#ttype').val() != "")
				{
					typ = $('#ttype').val();
				}else{
					typ = "";
				}
			}else{
				typ = $('#type').val();
			}
			
			var param = [	
							{ "name":"pid", value: pid},
							{ "name":"immat", value: $('#immat').val()},
							{ "name":"kilo", value: $('#kilo').val()}, 
							{ "name":"markmod", value: $('#markmod').val()},
							{ "name":"type", value: typ},
							{ "name":"pv", value: $('#pv').val()}, 
							{ "name":"prop", value: $('#prop').val()},
							{ "name":"stat", value: stat},
							{ "name":"action", value: act},
							{ "name":"limit", value: $('#limit').val() }
						]
			
			$.post('vehicule/insert_veh', param, function(data) {
				if (data) {
					// alert(data);
					cr_pop(data);
				}
			}, "text");
		});
	}
	
	function charg_dest()
	{
		var a = [];
		$.post('vehicule/all_dest', a, function(data) {
			if (data) {
				var its = data.getElementsByTagName('item');
				
				var content = [];
					content.push('<ul align="left">');
					
					for( var i = 0; i < its.length; i++ )
					{
						content.push('<li name="dest_'+its[i].attributes[0].nodeValue+'"  align="left"><a align="left"><span align="left"><div class="lab_dest" style=" max-width:50%; display:inline-block;">'+its[i].attributes[1].nodeValue);
							content.push('</div><div class="divbtt"><div style="display:inline-block; margin:0px 10px 0px 10px;" onclick="mod_dest('+its[i].attributes[0].nodeValue+', \''+its[i].attributes[1].nodeValue+'\')"><img style="vertical-align:middle;" src="'+$('#imgurl').val()+'edit.gif'+'"/></div>');
							content.push('<div style="display:inline-block; margin:0px 10px 0px 10px;" onclick="supp_dest('+its[i].attributes[0].nodeValue+')"><img style="vertical-align:middle;" src="'+$('#imgurl').val()+'cancel1.png'+'"/></div></div>');
						content.push('</span></a></li>');	
					}
				
					content.push('</ul>');
				var cont = content.join("");
				content = null;
				
				$('#cont_dest').html(cont);
			}
		}, "xml");
	}
	
	function supp_dest( a )
	{
		$("#ann_dest").trigger('click');
		
		var ok = confirm (" Êtes vous sûr de vouloir suppprimer cette destination? ");
		
		if ( ok == true )
		{
			var param = [ 
						{ "name" : "id", value : a }, 
						{ "name" : "val", value : 'Supprimer' } 					
					]; 
			$('#cont_dest').html("<img src=\""+$('#imgurl').val()+"29.gif\" >");
			$.post('vehicule/add_dest', param, function(data) 
			{
				if(data)
				{
					charg_dest();
					$('#mess_text').html(data);
					$('#message').show();
					window.setTimeout( function()
					{
						$('#message').hide();
					}, 2000);
				}
			}, "text");
			
		}else{
			return false;
		}
	}
	
	function mod_dest( a , b )
	{
		$('#iddest').val(a);
		$('#oldlib').val(b);
		$('#libdest').val(b);
		$('#val_dest').val("Modifier");
		$('#ann_dest').show();
	}
	
	$('#val_dest').click(function(){
		if( this.value == "Modifier" )
		{
			if( $('#oldlib').val() == $('#libdest').val() )
			{
				$("mess_text").html("<p> Veuillez changer le libellé de la destination...</p>");
				$('#message').show();
				return false;
			}
			
			var param = [ 
							{ "name": "id", value: $('#iddest').val() }, 
							{ "name": "lib", value: $("#libdest").val() },
							{ "name": "val", value: 'Modifier'}
						];
		}else{
			var param = [ 
							{ "name": "lib", value: $("#libdest").val() },
							{ "name": "val", value: 'Ajouter'}
						];
		}
		
		$('#cont_dest').html("<img src=\""+$('#imgurl').val()+"29.gif\" >");
		$.post('vehicule/add_dest', param, function(data) 
		{
			if(data)
			{
				charg_dest();
				$('#mess_text').html(data);
				$('#message').show();
				window.setTimeout( function()
				{
					$('#message').hide();
				}, 2000);
				
				$('#ann_dest').trigger('click');
			}	
		}, "text");
	});
	
			
	
	
	$('#switch').click(function(){
		
		$('#destination').css('visibility','visible');
		charg_dest();
		
	});
	
	$('#ex_des').click( function(){ 
		$('#destination').css('visibility','hidden');
		
	});
	
	$("#ann_dest").click(function(){
		$('#iddest').val("");
		$('#oldlib').val("");
		$('#libdest').val("");
		$('#val_dest').val("Ajouter");
		$('#ann_dest').hide();
	});
	
	function close_spl()
	{
		$("#div_spl").fadeOut();
		$('.filtre').removeAttr('style');
		$('.excel').removeAttr('style');
	}
	
	function extract(a)
	{
		
		var td = a.parentElement;
		var tr = td.parentElement;
		var tbody = tr.parentElement;
		
		var chkbx = tbody.getElementsByTagName('input');
		var name = "";
		var label = "";
		for( var i = 0; i < chkbx.length; i++ )
		{
			if( chkbx[i].type == "checkbox" )
			{
				if( chkbx[i].checked )
				{				
					name += chkbx[i].name+";";
					label += chkbx[i].value+";";
				}	
			}
		}
		
		var param = [
						{ "name":"limit", value: $('#limit').val() },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() },
						{ "name":"immat", value:$('#r_immat').val() },
						{ "name":"mrk", value:$('#r_mrk').val() },
						{ "name":"type", value:$('#r_type').val() },
						{ "name":"stat", value:$('#r_stat').val() },
						{ "name":"pp", value:$('#r_pp').val() },
						{ "name":"champs", value:name },
						{ "name":"label", value:label }
					]
		$.post( "vehicule/extract", param, function(data){
			if(data)
			{
				window.open(data); 
			}
		}, "text");
	}
	
	function find()
	{
		// initialisation des champs hidden contenant les parametres de recherche...
			$('#r_immat').val( $('#f_immat').val() );
			$('#r_mrk').val( $('#f_mark').val() );
			$('#r_type').val( $('#f_type').val() );
			$('#r_stat').val( $('#f_stat').val() );
			$('#r_pp').val( $('#f_pp').val() );
		//==========================================================================
		
		var param = [
						{ "name":"limit", value: $('#limit').val() },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() },
						{ "name":"immat", value:$('#f_immat').val() },
						{ "name":"mrk", value:$('#f_mark').val() },
						{ "name":"type", value:$('#f_type').val() },
						{ "name":"stat", value:$('#f_stat').val() },
						{ "name":"pp", value:$('#f_pp').val() }
					]
					
		// alert($('#f_cat').val())			
		$.post( "vehicule/refresh_veh", param, function(data){
			if(data)
			{
				// alert(data);
				var target = document.getElementById('showf');
				load_rw( data, target );
				
				var nbr = data.getElementsByTagName('nbre')[0];
				$('#num_rows').val(nbr.attributes[0].nodeValue);
				
				var stp = data.getElementsByTagName('step')[0];
				$('#step').val(stp.attributes[0].nodeValue);
				
				$('.navig_nb_record').html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
				
				var nom = $('#module').val();
				var _nom = "";
				var end = 0; 
				if(nom[nom.length-1] == 's')
				{
					end = nom.length-1;
				}else{
					end = nom.length;
				}

				for( var i = 0; i < end; i++ )
				{
					_nom += nom[i];
				}
				
				var nav_target = document.getElementById('page_1');
				var limit = parseInt($('#limit').val());
				var step = parseInt(stp.attributes[0].nodeValue);
				var num = parseInt(nbr.attributes[0].nodeValue);
				// alert( "limit : "+limit+" step : "+step+" num : "+num );
				$(nav_target).html("");
				
				load_range(nav_target, limit, step, num, _nom.toLowerCase());
			}
		}, "xml");
		window.setTimeout(function(){ $('#ex_mess').click() }, 2000);
	}
	
	function filtre(a)
	{
		if( $('#div_spl').length == 0 )
		{
			$('#body_content').append("<div id='div_spl' align='center'></div>");
		}
		
		$(a).attr("style","background-color:gray; color:white; ");
		$('.excel').removeAttr('style');
		var pos = $(a.parentElement).offset();
		
		
		$('#div_spl').css('top',pos.top+20).css('left',pos.left).fadeIn('slow');
		
		var cont = [];
		cont.push( "<table class='form' style='margin:20px; max-width:300px;'><colgroup><col width='40%' /><col width='60%' /></colgroup>" );
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Immatriculation : </td><td align='left' style='padding-left:20px;'><input id='f_immat' type='text' class='input_type'/></td></tr>");
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Marque : </td><td align='left' style='padding-left:20px;'><input id='f_mark' type='text' class='input_type'/></td></tr>");
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> type : </td><td align='left' style='padding-left:20px;'><input id='f_type' type='text' class='input_type'/></td></tr>");
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Statut : </td><td align='left' style='padding-left:20px;'><input id='f_stat' type='text' class='input_type'/></td></tr>");
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Propriétaire : </td><td align='left' style='padding-left:20px;'><input id='f_pp' type='text' class='input_type'/></td></tr>");
			// cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Categorie : </td><td align='left' style='padding-left:20px;'><select id='f_cat' class='input_type'>");
				// cont.push("<option></option>");
				// cont.push("<option value='a'>A</option>");
				// cont.push("<option value='b'>B</option>");
				// cont.push("<option value='be'>BE</option>");
				// cont.push("<option value='c'>C</option>");
				// cont.push("<option value='ce'>CE</option>");
				// cont.push("<option value='d'>D</option>");
				// cont.push("<option value='de'>DE</option>");
				// cont.push("<option value='e'>E</option>");
			// cont.push("</select></td></tr>");
			cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Chercher' class='tpl_button_neutral' onclick='find();'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
		cont.push("</table>");
		
		var content = cont.join("");
		
		$('#div_spl').html(content);
		
	}
	
	function get_csv(a)
	{
		var names = [];
		var input_names = [];
		var ths = document.getElementById('tck_list').getElementsByTagName('thead')[0].getElementsByTagName('th');
		
		for( var i = 0; i < ths.length; i++ )
		{
			names.push( ths[i].getElementsByTagName('a')[0].innerHTML );
			input_names.push( ths[i].getElementsByTagName('input')[0].name );
		}
		
		// names.push("Date Délivrance Permis");
		// names.push("Numéro de permis");
		// names.push("Catégories");
		// input_names.push("datedel");
		// input_names.push("nump");
		// input_names.push("cat");
		
		if( $('#div_spl').length == 0 )
		{
			$('#body_content').append("<div id='div_spl' align='center'></div>");
		}
		
		$(a).attr("style","background-color:gray; color:white; ");
		$('.filtre').removeAttr('style');
		var pos = $(a.parentElement).offset();
		
		
		$('#div_spl').css('top',pos.top+20).css('left',pos.left).fadeIn('slow');
		
		var cont = [];
		cont.push( "<table class='form' style='margin:20px; max-width:500px;'><colgroup><col width='50%' /><col width='50%' /></colgroup>" );
			var j = 0;
			for(var i = 0; i<names.length; i++)
			{
				if( j == 2 )
				{
					j = 0;
					cont.push("</tr><tr>");
				}
				
				cont.push("<td class='label' align='left' style='padding-left:20px; vertical-align:middle;'> <input style='vertical-align:middle; margin-right:15px;' type='checkbox' name='"+input_names[i]+"' value='"+names[i]+"'/> "+names[i]+" </td>");
				
				if( i == names.length-1 )
				{
					cont.push("</tr>");
				}
				
				j++;
			}
			cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Extraire' class='tpl_button_neutral' onclick='extract(this)'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
		cont.push("</table>");
		
		var content = cont.join("");
		
		$('#div_spl').html(content);
	}
	
	setInterval(function(){ 
		post_els( $('#id').val(), $('#limit').val(), "yes" );
	}, 30000);
	
	if( $('#id1').val() != "" )  
	{
		post_els( $('#id1').val(), $('#limit').val(), "yes" );
	}