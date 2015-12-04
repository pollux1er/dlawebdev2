function load_rw( data, Ac )
{
	if( $(Ac).attr('id') == "show_res" )
	{
		var nodes = data.getElementsByTagName('item');
		
		var content = [];
		if( nodes.length != 0 )
		{
			var ind_id = nodes[0].attributes[0].value;
			$('#id1').val(ind_id);
			for( var i = 0 ; i < nodes.length ; i++ )
			{
				content.push('<tr class="altcol cmd" onclick="modifier_res(this)" >');
				var tds = nodes[i].attributes;
				for ( var j = 0; j < tds.length; j++ )
				{
					content.push('<td class="align_center" valign="middle" ');
					if( (j == 0) )
					{
						content.push(' style="display:none; height:35px;" >'+tds[j].nodeValue+'</td>');
					}else{
						if( j == 1)
						{
							var cont = tds[j].nodeValue.split('-');
							var style = "";
							var clock = "";
							
							if(cont[1] == "STAND BY")
							{
								style = "height:35px; background-color: white; color:black; border: 1px solid black;";
							}else if(cont[1] == "DEPART"){
								style = "height:35px; background-color: darkgreen; color:white; border: 1px solid black;";
							}else if(cont[1] == "RETOUR"){
								style = "height:35px; background-color: darkred; color:white; border: 1px solid black;";
							}else{
								style = "height:35px; background-color: yellow; color:black; border: 1px solid black;";
							}
							
							if( cont.length == 3 )
							{
								clock = "<span style=\"\"> <img style=\"margin-left:3px; vertical-align:middle;\" src=\""+$("#imgurl").val()+'Alarm_clock1.png'+"\" /> </span>"
							}
							
							content.push( 'style = "'+style+'"><input type="hidden" value="'+cont[0]+'"><b>'+cont[1]+'</b> '+clock+'</td>');
						
						}else if ( (j == 6) || (j == 9) ){
							var cont = tds[j].nodeValue.split('-');
							content.push('><input id="cd_dem" type="hidden" value="'+cont[0]+'" />'+(cont[1])+'</td>');
						}else{
							content.push('>'+tds[j].nodeValue+'</td>');
						}
						
					}
				}
				
				content.push('</tr>')
			}
			
			var cont = content.join("");
			content = null;		
			
			$(Ac).html( cont );
		}else{
			content.push('<tr class="altcol cmd" ><td colspan="10" align="center"> Aucun enregistrement </td></tr>');
			
			var cont = content.join("");
			content = null;	
			$(Ac).html( cont );
		}
	}else{
		var nodes = data.getElementsByTagName('item');
		var content = [];
		
		var targ = $(Ac).attr('id');
		
		if( nodes.length != 0 )
		{
			var ind_id = nodes[0].attributes[0].value;
			var cont_id = $('#id');
	
			if( ($('#n_val').length != 0) && ($('#n_val').val() != "") )
			{
				cont_id = $('#id2');
			}
			
			cont_id.val(ind_id);
			for( var i = 0 ; i < nodes.length ; i++ )
			{
				content.push('<tr class="altcol cmd" onclick="modifier(this)" >');
				var tds = nodes[i].attributes;
				for ( var j = 0; j < tds.length; j++ )
				{
					if( j != (tds.length-1) ){
						if((j == 0) || (j >= 4))
						{
							content.push('<td style="display:none;" >'+tds[j].nodeValue+'</td>');
						}else{
							content.push('<td class="align_center" valign="middle" >'+Utf8.decode(tds[j].nodeValue)+'</td>');
						}
					
					}else{
					
						var stt = "";
						if ( tds[j].nodeValue == "valider" )
						{
							stt = "url(./assets/images/button_ok.gif) no-repeat scroll 50% transparent";
						}else if ( tds[j].nodeValue == "modifier" )
						{
							stt = "url( ./assets/images/edit.gif) no-repeat scroll 50% transparent";
						}else if ( tds[j].nodeValue == "annuler" )
						{
							stt = "url(./assets/images/cancel1.png) no-repeat scroll 50% transparent";
						}else if ( tds[j].nodeValue == "new" )
						{
							stt = "url(./assets/images/new-text.png) no-repeat scroll 50% transparent";
						}else if ( tds[j].nodeValue == "relance1" )
						{
							stt = "url(./assets/images/auto/relance_vert.png) no-repeat scroll 50% transparent";
						}else if ( tds[j].nodeValue == "relance2" )
						{
							stt = "url(./assets/images/auto/relance_red.png) no-repeat scroll 50% transparent";
						}else if ( tds[j].nodeValue == "Stand By" )
						{
							stt = "url(./assets/images/auto/stand_by.png) no-repeat scroll 50% transparent";
						}else{
							stt = "url(./assets/images/flag_green.png) no-repeat scroll 50% transparent";
						}
						
						content.push('<td class="align_center" valign="middle" style="background:'+stt+'" ><input type="hidden" value="'+tds[j].nodeValue+'"></td>');
					}
				}
				
				content.push('</tr>')
			}
			
			var cont = content.join("");
			content = null;		
			
			$(Ac).html( cont );
			
			lignes = document.getElementById(targ).getElementsByTagName('tr');
			if( (targ == "showf") && ( ($('#new_form').css("visibility") == "hidden") || ($('#new_form').attr("style") == "visibility:hidden;") ) )
			{
				
				$(lignes[0]).trigger('click');
			}else if(targ == "n_form_show")
			{
				$(lignes[0]).trigger('click');
			}
		} else {
			content.push('<tr class="" ><td colspan="4" align="center"> Aucun enregistrement </td></tr>');
			
			var cont = content.join("");
			content = null;	
			$(Ac).html( cont );
			
			// if( (targ == "showf") && ( ($('#new_form').css("visibility") == "hidden") || ($('#new_form').attr("style") == "visibility:hidden;") ) )
			// {
				// $('#visu').html("");
			// }else if(targ == "n_form_show")
			// {
				// $('#visu').html("");
			// }
			$('#visu').html("");
		}
	}
	
	return true;
}

/////////////////////////////////////////////////////////////////////////////////////////////
//																						   //		
//   cr&eacute;ation de reservation : fonction de chargement des champs v&eacute;hicules et chauffeurs;  //
//																						   //
/////////////////////////////////////////////////////////////////////////////////////////////
//--> Begin
	
	function load_car_chf( a )
	{
		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) 
			{
				$('#mess_text').html('');
				$('#ex_mess').show();
				l_c_c(xhr.responseXML, a);
			}else{
				$('#ex_mess').hide();
				$('#mess_text').html('<img src="'+$('#imgurl').val()+'24.gif'+'">');
			}
		};
		
		xhr.open("POST", "reservation/load_car_chf", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(null);
	}
	
	function l_c_c(Ddata, Aa)
	{
		// alert(Ddata)
		var content = []
		content.push('<div style=" max-width:500px; background-color: white;">');
		content.push('<div class="title">Choix Vehicule - Chauffeur</div>')
		content.push('<table id="tab_ch" style=" border: 1px solid lightgray; width:100%"><tr><td align="left" style="padding:10px;">');
		
		//-- partie voiture 
		
			content.push('<b>Voitures disponibles : </b></td>');
			
			var cars = Ddata.getElementsByTagName("cars");
			// var attrs1 = cars[0].attributes;
			
			if( cars.length == 0 )
			{
				content.push('<td align="left"><p> Pas de v&eacute;hicule disponible... </p></td></tr>');
			}else{
				content.push('<td align="left"><select id="ch_vtr" class="input_type">')
				content.push('<option></option>');
				for( var i = 0; i<cars.length; i++ )
				{
					content.push('<option value="'+cars[i].attributes[0].nodeValue+'-'+cars[i].attributes[2].nodeValue+'" > '+cars[i].attributes[1].nodeValue+" "+cars[i].attributes[3].nodeValue+' </option>');
				}
				
				content.push('</select></td></tr>');
			}
				
				
		if( Aa == "OUI"){	
			//-- partie chauffeur
			
			content.push('<tr><td align="left" style="padding:10px;"><b>Chauffeurs disponibles : </b></td>');
			
			var drvs = Ddata.getElementsByTagName("chfs");
		
			if( drvs.length == 0 )
			{
				content.push('<td align="left"><p> Pas de chauffeur disponible... </p></td></tr>');
			}else{
				content.push('<td align="left"><select id="ch_chr" class="input_type">')
				content.push('<option></option>');
				for( var i = 0; i<drvs.length; i++ )
				{
					content.push('<option value="'+drvs[i].attributes[0].nodeValue+'" > '+drvs[i].attributes[1].nodeValue+" "+drvs[i].attributes[2].nodeValue+' ('+drvs[i].attributes[3].nodeValue+') </option>');
				}
				
				content.push('</select></td></tr>');
			}
			
		}
		
		
		//content.push('<tr><td align="left" style="padding:10px;"><b>Kilom&eacute;trage : </b></td><td align="left"><input id="kilom" type="text" class="input_type"/></td></tr>');
			
		
		content.push('</table><br>');
		if(( Aa == "OUI" )  &&  ( drvs.length != 0 ) && (  cars.length != 0  )){
			content.push('<div style="padding-bottom:10px;"><input id="val_ch" class="tpl_button_insert" type="button" value="OK" onclick="_ok(this);">&nbsp;&nbsp;<input id="an_ch" class="button_action_ann" type="button" value="Annuler" onclick="_annuler();"></div>');
		}
		
		if(( Aa == "NON" ) && (  cars.length != 0  )){
			content.push('<div style="padding-bottom:10px;"><input id="val_ch" class="tpl_button_insert" type="button" value="OK" onclick="_ok(this);">&nbsp;&nbsp;<input id="an_ch" class="button_action_ann" type="button" value="Annuler" onclick="_annuler();"></div>');
		}
		
		content.push('<br></div>');
		var div_res = content.join("");
		
		var mess = $('#mess_text');
		mess.append(div_res);
		$('#date').datepick();
	}
	
//--> End

///////////////////////////
//  Choix du formulaire  //
///////////////////////////

function modifier(a)
{
	var cible_id = "tck_list";
	var cont_id = $('#id');
	
	if( ($('#n_val').length != 0) && ($('#n_val').val() != "") )
	{
		cible_id = "tck_list1";
		cont_id = $('#id2');
	}
	
	line_color(a, cible_id);
	
	var tds = a.getElementsByTagName('td');
	var names = [];
	var visu = $('#visu');
	
	visu.html("");
	
	cont_id.val(trim(tds[0].innerHTML));
	
	var check_rsrv = false;
	
	var content = [];
	
	var ths = document.getElementById('tck_list').getElementsByTagName('thead')[0].getElementsByTagName('th');
	for(var i = 0; i < ths.length; i++)
	{
		names.push(trim(ths[i].getElementsByTagName('a')[0].innerHTML));
	}
	// alert(names.length);
	var mot = trim(tds[6].innerHTML).split('@ precision : @');
	var dest = trim(tds[3].innerHTML);
	
	if( dest == "3rd Party" )
	{
		dest = dest+" ( "+mot[1]+" )";
	}
	
	for( var i=0; i<names.length-1; i++)
	{
		if( i == 0 )
		{
			content.push('<div id="t_div"> Formulaire N'+Utf8.decode("°"));
			content.push(trim(tds[i].innerHTML)+'</div><div style="height:310px; max-height:350px; overflow-y:scroll; " ><table id="tab_visu" class="form" style="width:80%; margin:20px;"> <colgroup><col width ="35%"><col width="65%"></colgroup><tr style="display:none"><td align="left" class="label" style="height:25px;">');
			content.push(names[i]+'</td><td align="left">');
			content.push(trim(tds[i].innerHTML)+'</td></tr><tr><td align="left" class="label" style="height:25px;">');
		}else if((i > 0) && (i < names.length-2) && ( i != 3 ) && ( i != 6 ) ){
			content.push(names[i]+'</td><td align="left">');
			content.push(trim(tds[i].innerHTML)+'</td></tr><tr><td align="left" class="label" style="height:25px;">');
		}else if( i == 3 ){
			content.push(names[i]+'</td><td align="left">');
			content.push(dest+'</td></tr><tr><td align="left" class="label" style="height:25px;">');
		}else if( i==6 ){
			content.push(names[i]+'</td><td align="left">');
			content.push(mot[0]+'</td></tr><tr><td align="left" class="label" style="height:25px;">');
		}else{
			
			if( names[i] == "Chauffeur" )
			{
				content.push(names[i]+'</td><td align="left">');
				var chfr = ""
				if(trim(tds[i].innerHTML) == '1')
				{
					chfr = "OUI";
				}else{
					chfr = "NON";
				}
				content.push(chfr+'</td></tr>');
			}			
		}
	}
	
	var stat = trim(tds[10].getElementsByTagName('input')[0].value);
	// alert(stat);
	content.push('</table></div><br>');
	var contentHTML = content.join("");
	content = null;
	
	visu.append(contentHTML);
	
	visu.append('<div id="div_butt" ></div>');
	
	var div_b = $('#div_butt');
	if(stat == 'valider')
	{
		div_b.append('<input id="mod_res" value="Modifier '+Utf8.decode("r&eacute;servation")+'"  type="button" class="button_action_eqp_rubber" style="width:150px;"> &nbsp;&nbsp; ');
		div_b.append('<input id="cr_res"  value="'+Utf8.decode("Cr&eacute;er r&eacute;servation")+'" type="button" class="tpl_button_insert" style="width:150px;"/> &nbsp;&nbsp; '); 
		div_b.append('<input id="an_res" value="Annuler '+Utf8.decode("r&eacute;servation")+'" type="button" class="button_action_ann" style="width:150px;"/> &nbsp;&nbsp;');
		div_b.append('<input id="ann" value="Annuler" type="button" style="display:none;" class="button_action_ann" style="width:150px;"/>');
	}else if(stat == 'modifier')
	{
		div_b.append('<b>'+Utf8.decode("Demande modifi&eacute;")+'</b>');
	}else if(stat == 'annuler')
	{
		div_b.append('<b>'+Utf8.decode("Demande annul&eacute;e")+'</b>');
	}else if(stat == 'reserver'){
		div_b.append('<b>'+Utf8.decode("Demande valid&eacute;e et R&eacute;servation effectu&eacute;e")+'</b>');
	}else{
		// div_b.append('<input id="valider" value="valider" type="button" style="" class="tpl_button_validate" style="width:150px;"/> &nbsp;&nbsp; ');
		div_b.append('<input id="relance" value="Relancer" type="button" style="" class="button_action_ann button_action_mod" style="width:150px;"/> &nbsp;&nbsp; ');
		div_b.append('<input id="an_res" value="Annuler" type="button" style="" class="button_action_ann" style="width:150px;"/>');
	}
	
	var mod_res = $('#mod_res');
	var cr_res = $('#cr_res');
	var an_r = $('#an_res');
	var ann = $('#ann');
	var relance = $('#relance');
	var valider = $('#valider');
	var tab_visu = document.getElementById('tab_visu');
	
	var trs = tab_visu.getElementsByTagName('tr');
	
	var d1 = trim(trs[4].getElementsByTagName('td')[1].innerHTML);
	var d2 = trim(trs[5].getElementsByTagName('td')[1].innerHTML);
	var id_f = trim(trs[0].getElementsByTagName('td')[1].innerHTML);
	var v_ch = trim(trs[9].getElementsByTagName('td')[1].innerHTML);
	
	// les lignes de date-heure depart et date-heure retour et valeur de chauffeur
	var date_hr = trs[4].getElementsByTagName('td')[1];
	var date_hr_1 = trs[5].getElementsByTagName('td')[1];
	var chauf = trs[9].getElementsByTagName('td')[1];
	
	/////////////////////////////////////////////////////////////
	//  validation d'un formulaire de demande par gestionnaire //
	/////////////////////////////////////////////////////////////
	
	valider.click(function(){
		var cont = [];
		
		cont.push("<div id='div_gest' style='height:250px;'>");
			cont.push("<table class='form' style='border:1px solid gray; width:400px;'> <colgroup><col width='40%'><col width='60%'></colgroup>");
				cont.push("<tr>");
					cont.push("<td valign='top' class='label' style='padding-left:10px; padding-top:20px;'> Justification (gestionnaire)</td>");
					cont.push("<td class=''><textarea id='motif' class='input_type' style='margin:20px 0px 20px 10px; height:100px; max-height:100px; width:200px; max-width:200px;'></textarea></td>");
				cont.push("</tr>");
				cont.push("<tr>");
					cont.push("<td align='center' colspan='2' style='padding:20px;'> <input id='ok_gest' type='button' class='tpl_button_validate' value='OK' /> </td>");
				cont.push("</tr>");
			cont.push("</table>")
		cont.push("</div>");
		
		var content = cont.join("");
		
		$('#mess_text').html(content);
		$('#message').show();
		
		var ok_gest = $('#ok_gest');
	
		ok_gest.click(function(){
			
			if( trim($('#motif').val()) != "" )
			{
				var param = [ 
								{"name": "id", value: trim(tds[0].innerHTML)} , 
								{"name": "motif_gest", value: trim($('#motif').val()) } 
							]
				$.post('reservation/validation', param, function(data){
					if(data)
					{
						$('#mess_text').html(data);
						$('#message').show();
						
						window.setTimeout( function(){
							$('#ex_mess').trigger('click');
						}, 2000 );
					}
				}, "text");
			}else{
				var pop = $('#pop');
				if( $('#pop').length == 0 )
				{
					$('#div_gest').append("<div id='pop'><p>Veuillez remplir le champs</p></div>");	
				}else{
					$('#pop').show();
				}
				
				window.setTimeout( function(){ $('#pop').hide(); }, 2000 );
			}
		});
	});
	
	
	
	///////////////////////////////////////////////
	//  Modification d'un formulaire de demande  //
	///////////////////////////////////////////////
	
	// call back check date of creation, take-off & arrival
	
	mod_res.click(function(){
		var d0 = trim( trs[1].getElementsByTagName('td')[1].innerHTML );
		// alert(d0);
		var d11 = trim(date_hr.innerHTML); // date et heure depart
		var d21 = trim(date_hr_1.innerHTML); // date et heure arrivee
		var id_f1 = trim(trs[0].getElementsByTagName('td')[1].innerHTML); // id du formulaire
		// var v_ch = trim(chauf.innerHTML); // Valeur chauffeur
		// alert(d4);
		// alert("Modifier "+Utf8.decode('réservation'));
		if( this.value == "Modifier "+Utf8.decode('réservation')){
			cr_res.hide();
			an_r.hide();
			ann.show();
			mod_res.val("Envoyer Proposition");
			mod_res.attr("class","tpl_button_insert");
		
		
			date_hr.innerHTML = "";
			date_hr_1.innerHTML = "";
			chauf.innerHTML = "";
			
			var mins = [];
			var hs = [];
			for(var i = 0; i < 24; i++)
			{
				if(i < 10)
				{
					hs.push('0'+i);
				}else
				{
					hs.push(i);
				}
			}
			
			for(var i = 0; i < 60; i++)
			{
				if(i < 10)
				{
					mins.push('0'+i);
				}else
				{
					mins.push(i);
				}
			}
			
			content = [];
			content.push('<option></option>');
			for(var i = 0; i < hs.length; i++)
			{
				content.push('<option value="'+hs[i]+'">'+hs[i]+'</option>');
			}
			var date = content.join("");
			content = null;
			
			content = [];
			content.push('<option></option>');
			for(var i = 0; i < mins.length; i++)
			{
				content.push('<option value="'+mins[i]+'">'+mins[i]+'</option>');
			}
			var min = content.join("");
			content = null;
			//--- creation du input date 1 et 2
			
			//1
			$(date_hr).append('<u>Date</u> : <input id="dd" type="text" class="input_type" style="width:60px;"/>&nbsp;');
			$(date_hr).append('<u>heure</u> : <select id="hr_dep" class="input_type"></select>&nbsp;');
			$(date_hr).append('<select id="min_dep" class="input_type"></select>');
			$('#dd').datepick();
			
			//2
			$(date_hr_1).append('<u>Date</u> : <input id="dr" type="text" class="input_type" style="width:60px;"/>&nbsp;');
			$(date_hr_1).append('<u>heure</u> : <select id="hr_fin" class="input_type"></select>&nbsp;');
			$(date_hr_1).append('<select id="min_fin" class="input_type"></select>');
			$('#dr').datepick();
			
			//3
			$(chauf).append('<select id="chf" class="input_type" ><option></option><option value="0">NON</option><option value="1">OUI</option></select>')
			
			//--- creation du select heure 1 et 2
			var hrd = $('#hr_dep'); var mrd = $('#min_dep');
			var hrf = $('#hr_fin'); var mrf = $('#min_fin');
			
			//1
			d11 = d11.split(' ');
			$('#dd').val(d11[0]);
			hrd.append(date);
			mrd.append(min);
			_d1 = d11[1].split(':'); 
			hrd.val(_d1[0]);
			mrd.val(_d1[1]);
				
			//2
			d21 = d21.split(' ');
			$('#dr').val(d21[0]);
			hrf.append(date);
			mrf.append(min);
			_d2 = d21[1].split(':');
			hrf.val(_d2[0]);
			mrf.val(_d2[1]);
			
			//3
			$('#chf').val(v_ch);
		}else{
			var t_min_d = $('#hr_dep').val()+':'+$('#min_dep').val()+':00';
			var t_min_f = $('#hr_fin').val()+':'+$('#min_fin').val()+':00';
			var check = false; 
			var thrmd = $('#dd').val()+" "+t_min_d;
			var thrmf = $('#dr').val()+" "+t_min_f;
			if(thrmd < d0){
				$('#mess_text').html("<p>Veuillez entrer une date de d&eacute;part plus r&eacute;cente ou &eacute;gale &agrave; la date de cr&eacute;ation du formulaire<p>");
				$('#message').show();
				check = true;
			}
			
			if(thrmf < d0){
				$('#mess_text').html("<p>Veuillez entrer une date de retour plus r&eacute;cente ou &eacute;gale &agrave; la date de cr&eacute;ation du formulaire<p>");
				$('#message').show();
				check = true;
			}
			
			if(thrmf <= thrmd){
				$('#mess_text').html("<p>Veuillez entrer une date de retour plus r&eacute;cente que la date de d&eacute;part pr&eacute;vue.<p>");
				$('#message').show();
				check = true;
			}
			
			var ch = ((v_ch == "OUI") ? "1" : "0"); 
			if( ( thrmd == d1 ) && ( thrmf == d2 ) && ( $('#chf').val() == ch ) ) 
			{
				$('#mess_text').html("<p>Veuillez effectuer une modification...<p>");
				$('#message').show();
				check = true;
				// alert('bingo');
			}
			// alert( thrmd+	"====="+d1+" ; "+thrmf +"====="+d2+" ; "+$('#chf').val()+"=====" );
			if( check == false ){
				send_mod(id_f1, $('#dd').val(), t_min_d, $('#dr').val(), t_min_f, $('#chf').val());
				ann.trigger('click');
			}
		}
	});
	
	
	
	
	/////////////////////////////////////////////////////
	//  Annulation de la modification d'un formulaire  //
	/////////////////////////////////////////////////////
	
	ann.click(function(){
		cr_res.show();
		an_r.show();
		ann.hide();
		mod_res.val("Modifier "+Utf8.decode('réservation'));
		mod_res.attr("class","button_action_eqp_rubber");
		date_hr.innerHTML = d1;
		date_hr_1.innerHTML = d2;
		chauf.innerHTML = v_ch;
	});
	
	var alt = trim(document.getElementById('tab_visu').getElementsByTagName('tr')[9].getElementsByTagName('td')[1].innerHTML);
	
	an_r.click(function(){
		
		var param = [	
						{ name:"id", value:id_f  },
						{ name:"act", value:"logged"  }
					];
		
		$.post('reservation/valid_mod', param, function(data){
			if(data){
				$('#message').show();
				$('#mess_text').html("<p>"+data+"</p>");
				window.setTimeout( function(){ $('#ex_mess').trigger('click'); }, 2000);
				
				var param = 	[ 
									{ "name":"sort" , value: $('#sort').val() },
									{ "name":"order" , value: $('#order').val() },
									{ "name":"limit" , value: $('#limit').val() },
									{ "name":"step" , value: $('#step').val() },
									{ "name":"id" , value: id_f}
								]
				
				var show = "showf";
			
				if( ($('#n_val').length != 0) && ($('#n_val').val() != "") )
				{
					show = "n_form_show";
					param[param.length] = { "name":"new", value: "new" }; 
				}
					
				$.post( "reservation/rgform", param, function(data){
					if(data)
					{
						alert(data);
						
						var target = document.getElementById(show);
						load_rw( data, target);
							
						var nbr = data.getElementsByTagName('nbre')[0];
						$('#num_rows').val(nbr.attributes[0].nodeValue);
						
						var stp = data.getElementsByTagName('step')[0];
						$('#step').val(stp.attributes[0].nodeValue);
						
						var gDiv = target.parentElement.parentElement;
						
						if ($(target).attr('id') == 'n_form_show')
						{
							var cDiv_ = gDiv.getElementsByTagName('div')[2];
							charg_late( $('#num_ret') );
							charg_alert( $('#num_al') );
						}else{
							var cDiv_ = gDiv.getElementsByTagName('div')[1];
						}
						
						$(cDiv_.getElementsByTagName('div')[0]).html( nbr.attributes[0].nodeValue+" &Eacute;l&eacute;ment(s)" );
						
						var nav_target = cDiv_.getElementsByTagName('div')[1];
						var limit = parseInt($('#limit').val());
						var step = parseInt(stp.attributes[0].nodeValue);
						var num = parseInt(nbr.attributes[0].nodeValue);
									
						$(nav_target).html("");
								
						load_range(nav_target, limit, step, num, 'reservation_rgform');
				
					}
				}, "xml");
			}
		}, 'text');
	});
	
	//////////////////////////////////
	//  Cr&eacute;ation d'une r&eacute;servation  //
	//////////////////////////////////
		
	cr_res.click(function(){
		load_car_chf( alt );
		var message = $('#message');
		message.show();
		
		$('#date').datepick();
	});
	
	relance.click(function(){
		$('#message').show();
		$('#mess_text').html('<img src="'+$('#imgurl').val()+'29.gif" />');
		$('#ex_mess').hide();
		var param = [ { "name":"id", value:id_f } ];
		$.post('reservation/send_mail', param, function(data){
			if(data)
			{
				$('#ex_mess').show();
				$('#mess_text').html(data);
				// window.setTimeout( function(){ $('#ex_mess').trigger('click') }, 2000 );
			}
		}, "text");
	});
}

	function ctrl_kil(){
		if($('#ch_vtr').val() == '')
		{
			alert("Veuillez d'abord choisir le v&eacute;hicule affact&eacute; SVP...");
			$('#kilom').focus();
		}else if (isNaN($('#kilom').val()) == true)
		{
			alert('Veuillez entrer une valeur num&eacute;rique');
			$('#kilom').val("");
		}
	}
	
	function _ok(){
		
		var vtr = $('#ch_vtr').val();
		var k = vtr.split('-');
		
		if( ($('#ch_vtr').val() == "") || ($('#ch_chr').val() == "") )
		{
			alert("Veuillez remplir tous les champs...");
			return false;
		}
	
		
		var param1 = trim(document.getElementById('tab_visu').getElementsByTagName('tr')[0].getElementsByTagName('td')[1].innerHTML);
		var param2 = $('#ch_vtr').val();
		var param3 = "";
		
		if( $('#ch_chr').length != 0 )
		{
			param3 = $('#ch_chr').val();
		}
		
		create_res(param1, param2, param3 , "" , "OK");
	}
	
	function _annuler(){
		$('#ex_mess').trigger('click');
	}
	
	var f_line = document.getElementById('tck_list').getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0];
	$(f_line).trigger('click');
	
	/////////////////////////////////////////////////////
	//   Fonction de modification chauffeur/vehicule   //
	/////////////////////////////////////////////////////
	
	function _ref_( a, b, c)
	{
		var mess_res = $('#mess_res')
		if( (b == "chauffeur") && ( c == "") )
		{
			mess_res.html('<p>Veuillez choisir un chauffeur</p>');
			mess_res.fadeIn();
			window.setTimeout(function(){mess_res.fadeOut();}, 5000);
			return false;
		}else if( (b == "vehicule") && ( c == "") ){
			mess_res.html('<p>Veuillez choisir un v&eacute;hicule</p>');
			mess_res.fadeIn();
			window.setTimeout(function(){mess_res.fadeOut();}, 5000);
			return false;
		}
		
		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				maj_reserv(xhr.responseXML);
				// alert(xhr.responseText);
				// $('#ex_mess').trigger('click');
			}else{
				
				$('#mess_text').html('<p>Modification en cours...</p><img src="'+$('#imgurl').val()+'24.gif'+'">');
				$('#message').show();
			}
		};
		
		xhr.open("POST", "reservation/modif_ch_v", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("id="+a+"&kel="+b+"&val="+c);
		
	}
	
	//////////////////////////////////
	//   Fais disparaitre les div   //
	//////////////////////////////////
	
	function remove_p(el)
	{
		var parent = $(el).parent();
		$(parent).remove();
	}
	
	///////////////////////////////////////////////////////////////////////////////////
	//   Chargement des v&eacute;hicules uniquement from fonction modifier_res()...  //
	///////////////////////////////////////////////////////////////////////////////////
	
	// ----> Debut
		function load_v( id )
		{
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					// $('#mess_text').html('');
					// $('#ex_mess').show();
					l_v(xhr.responseXML, id);
				}else{
					// $('#ex_mess').hide();
					// $('#mess_text').html('<img src="'+$('#imgurl').val()+'24.gif'+'">');
				}
			};
			
			xhr.open("POST", "reservation/load_car_chf", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(null);
		}
		
		function l_v(Ddata, Id)
		{
			
			var content = []
			if( $("#div_v").length == 0 )
			{
				content.push('<div id="div_v" style="background-color: white;">');
				content.push('<div class="img_clk" onclick="remove_p(this);" style="right:30px;" ><img src="'+$('#imgurl').val()+'exit_mini.png'+'" style="vertical-align:middle;" /> &nbsp; Fermer</div><div class="title"> Changer V&eacute;hicule </div>')
				
				content.push('<p style="padding:10px 0px 10px 0px; border:1px solid lightgray;"><b>Voitures disponibles : &nbsp;&nbsp;&nbsp;</b>');
					
					var cars = Ddata.getElementsByTagName("cars");
					// var attrs1 = cars[0].attributes;
					
					if( cars.length == 0 )
					{
						content.push('<p> Pas de v&eacute;hicule disponible... </p></tr>');
					}else{
						content.push('<td><select id="ch_vtr" class="input_type">')
						content.push('<option></option>');
						for( var i = 0; i<cars.length; i++ )
						{
							content.push('<option value="'+cars[i].attributes[0].nodeValue+'-'+cars[i].attributes[2].nodeValue+'" > '+cars[i].attributes[1].nodeValue+" "+cars[i].attributes[3].nodeValue+' </option>');
						}
						
						content.push('</select></p><br><input style="margin-bottom:20px;" type="button" class="tpl_button_insert" onclick="_ref_(\''+Id+'\', \'vehicule\', document.getElementById(\'ch_vtr\').value );" value="Changer"/></div>');
					}

				
				var cont = content.join("");
				$('#mess_text').append(cont);
			}
		}
	// ----> fin
	
	
	////////////////////////////////////////////////////////////////////////////
	//   Chargement des chauffeurs uniquement from fonction modifier_res()... //
	////////////////////////////////////////////////////////////////////////////
	
	// ----> Debut
		function load_c( id )
		{
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					// $('#mess_text').html('');
					// $('#ex_mess').show();
					l_c(xhr.responseXML, id);
				}else{
					// $('#ex_mess').hide();
					// $('#mess_text').html('<img src="'+$('#imgurl').val()+'24.gif'+'">');
				}
			};
			
			xhr.open("POST", "reservation/load_car_chf", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(null);
		}
		
		function l_c(Ddata, Id)
		{
			if( $("#div_ch").length == 0 )
			{
				var content = []
				content.push('<div id="div_ch" style="background-color: white;">');
				content.push('<div class="img_clk" onclick="remove_p(this);" style="right:30px;" ><img src="'+$('#imgurl').val()+'exit_mini.png'+'" style="vertical-align:middle;" /> &nbsp; Fermer</div><div class="title"> Changer Chauffeur </div>')
				
				content.push('<p style="padding:10px 0px 10px 0px; border:1px solid lightgray;"><b>Chauffeurs disponibles : &nbsp;&nbsp;&nbsp;</b>');
					
					var drvs = Ddata.getElementsByTagName("chfs");
					
					if( drvs.length == 0 )
					{
						content.push('<p> Pas de Chauffeur disponible... </p></tr>');
					}else{
						content.push('<td><select id="ch_chf" class="input_type">')
						content.push('<option></option>');
						content.push('<option value="36">AUCUN</option>');
						for( var i = 0; i<drvs.length; i++ )
						{
							content.push('<option value="'+drvs[i].attributes[0].nodeValue+'" > '+drvs[i].attributes[1].nodeValue+" "+drvs[i].attributes[2].nodeValue+' ('+drvs[i].attributes[3].nodeValue+') </option>');
						}
						
						content.push('</select></p><br><input style="margin-bottom:20px;" type="button" class="tpl_button_insert" onclick="_ref_(\''+Id+'\', \'chauffeur\', document.getElementById(\'ch_chf\').value );" value="Changer"/></div>');
					}

				
				var cont = content.join("");
				$('#mess_text').append(cont);
			}
		}
	// ----> fin
	
	///////////////////////////////////////////////////////
	//  Contrôle des statuts aves les champs conceern&eacute;s  //
	///////////////////////////////////////////////////////
	
	//---> debut
	function _ch_st(){
		
		var ch_st = document.getElementById('ch_st');
		var lb_st = document.getElementById('lb_st');
		var newdate = document.getElementById('newdate');
		var trs_ch = document.getElementById('tab_modres').getElementsByTagName('tr');
		var newkilo = document.getElementById('newkilo');
		var new_int = document.getElementById('new_int');
		var lien = $(ch_st).attr('class').split(' ');
		// alert($(ch_st).attr('class'));
		// var t = lien.length-1;
		
		if(lien[1] == "rightimg")
		{
			
			$(ch_st).hide();
			
			if(trim($(lb_st).text()) == "STAND BY")
			{
				$(lb_st).html("<b>DEPART</b>");
				$(lb_st).attr('style','display:inline-block; width:70px;; border-radius:10px 10px 10px 10px; background-color:darkgreen; color:white; vertical-align:top; padding:5px; border: 1px solid black;');
				trs_ch[6].getElementsByTagName('td')[0].innerHTML = "<b>heure de d&eacute;part : </b>";
				trs_ch[7].getElementsByTagName('td')[0].innerHTML= "<b>kilometrage d&eacute;part : </b>";
				trs_ch[6].style.display = "";
				trs_ch[7].style.display = "";
				
			}else if(trim($(lb_st).text()) == "DEPART") {
				
				$(lb_st).html("<b>RETOUR</b>");
				$(lb_st).attr('style','display:inline-block; width:70px;; border-radius:10px 10px 10px 10px; background-color:darkred ; color:white; vertical-align:top; padding:5px; border: 1px solid black;');
				trs_ch[6].getElementsByTagName('td')[0].innerHTML = "<b>heure d'arriv&eacute;e : </b>";
				trs_ch[7].getElementsByTagName('td')[0].innerHTML= "<b>kilometrage arriv&eacute;e : </b>";
				trs_ch[6].style.display = "";
				trs_ch[7].style.display = "";
			}
			
		}
		
		$('#div_ok').attr("style","display:inline-block");
	}
	//---> fin
	
	// fonction d'annulation d'une reservation
	function an_res(a)
	{
		// alert(a);
		var xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				maj_reserv(xhr.responseXML);
				$('#ex_mess').trigger('click');
			}else{
				$('#ex_mess').hide();
				$('#mess_text').html('<p>Mise &agrave; jour de la r&eacute;servation</p><img src="'+$('#imgurl').val()+'24.gif'+'">');				
			}
		};
			
		xhr.open("POST", "reservation/cancel", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("id="+a);
	}
	
	///////////////////////////////////////////////////
	//  Declenche par le clic sur une reservation   ///
	///////////////////////////////////////////////////
	
	function modifier_res(a){
		var message = $('#message');
		var m_txt = $('#mess_text');
		message.show();
		$('#messcontent').css('position','absolute');
		m_txt.html("");
		var tds = a.getElementsByTagName('td');
		
		$('#id1').val(trim(tds[0].innerHTML));
		
		//date format courant
		
		var date = trim(tds[2].innerHTML).split('-');
		var mois = new Array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre");
		
		var cur_date = trim(date[0]+' '+mois[parseInt(date[1])-1]+' '+date[2]);
		var butt_c = "";
		var butt_v = "";
		
		if((tds[1].innerText != "RETOUR") && (tds[1].innerText != "ANNULEE"))
		{
			var butt_c = '<input class="img_clk edit" style="" type="button" onclick="load_c('+tds[0].innerHTML+')" value="Modifier" />';
			var butt_v = '<input class="img_clk edit" style=""  type="button" onclick="load_v('+tds[0].innerHTML+')" value="Modifier"  />';
		}
		
		var content = [];
		content.push('<div id="ctrl_res" width="">');
		
		//--- contenu ------//
		content.push('<div align="center" class="title">R&eacute;servation N'+Utf8.decode("°")+' '+tds[0].innerHTML+' du '+cur_date+'</div>');
		content.push('<table id="tab_modres" style=" width:500px; border:1px solid lightgray;"><tr>');
		content.push('<td align="left"><b>Destinataire : </b></td><td align="left">');
		content.push(tds[5].innerHTML+'</td></tr><tr>');
		content.push('<td align="left"><b>D&eacute;part pr&eacute;vu le : </b></td><td align="left">');
		content.push(tds[3].innerHTML+'</td></tr><tr>');
		content.push('<td align="left"><b>Retour pr&eacute;vu le : </b></td><td align="left">');
		content.push(tds[4].innerHTML+'</td></tr><tr>');
		content.push('<td align="left"><b>Chauffeur : </b></td><td align="left"><input type="hidden" id="cd_dem" value="');
		content.push(tds[9].getElementsByTagName('input')[0].value+'"/>');
		content.push(tds[9].innerHTML+butt_c+'</div></td></tr><tr>');
		content.push('<td align="left"><b>Avec le v&eacute;hicule : </b></td><td align="left"><input type="hidden" id="cd_dem" value="');
		content.push(tds[6].getElementsByTagName('input')[0].value+'">');
		content.push(tds[6].innerHTML+' &nbsp;&nbsp;&nbsp; <b>( Marque-Mod&eacute;le : </b>'+tds[7].innerHTML+')'+butt_v+'</td></tr><tr>');
		
		// alert(tds[1].getElementsByTagName('b')[0].innerHTML);
		 var stat_val = tds[1].getElementsByTagName('b')[0].innerHTML;
		if(stat_val == "STAND BY")
		{
			content.push('<td align="left" valign="top"><b> Statut : </b></td><td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color:#fff; color:black; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}else if(stat_val == "DEPART"){
			content.push('<td align="left" valign="top"><b> Statut : </b></td><td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color: darkgreen; color:white; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}else if(stat_val == "RETOUR"){
			content.push('<td align="left" valign="top"><b> Statut : </b></td><td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color: darkred; color:white; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}else{
			content.push('<td align="left" valign="top"><b> Statut : </b></td><td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color: yellow; color:black; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}
		
		content.push('<b>'+stat_val+'</b></div> &nbsp;&nbsp;&nbsp; ');
		
		if((stat_val != "RETOUR") && (stat_val != "ANNULEE"))
		{
			content.push('<div style="display:inline-block; margin-top:5px;" onclick="_ch_st();"><input id="ch_st" type="button" class="arrow rightimg"> </div>');
		}
		content.push('</td></tr>');
		content.push('<tr style="display:none;"><td align="left"></td><td align="left"> <select id="newhr" class="input_type">');
			
			var hs = [];
			for(var i = 0; i < 24; i++)
			{
				if(i < 10)
				{
					hs.push('0'+i);
				}else
				{
					hs.push(i);
				}
			}
			
			content.push('<option></option>');
			for(var i = 0; i < hs.length; i++)
			{
				content.push('<option value="'+hs[i]+'">'+hs[i]+'</option>');
			}
			
			content.push('</select>&nbsp;&nbsp; <select id="newmin" class="input_type">');
			
			var mins = [];
			for(var i = 0; i < 60; i++)
			{
				if(i < 10)
				{
					mins.push('0'+i);
				}else
				{
					mins.push(i);
				}
			}
			
			content.push('<option></option>');
			for(var i = 0; i < mins.length; i++)
			{
				content.push('<option value="'+mins[i]+'">'+mins[i]+'</option>');
			}
			
		content.push('</select></td></tr> <tr style="display:none;"><td align="left"></td><td align="left"><input id="newkilo" type="text" class="input_type" onkeyup="check_int(this);"></td></tr></table>');

		if((stat_val != "RETOUR"))
		{
			content.push('<br><div id="div_ok" style="display:none;"> <input id="val_mod" class="tpl_button_validate" type="button" value="OK" style="width:150px;"></div>');				
		}
		
		if((stat_val == "STAND BY"))
		{
			content.push('<div id="div_an" style="margin-left:5px; display:inline-block;"> <input id="val_ann" class="button_action_ann" type="button" value="Annuler R&eacute;servation"></div>');
			
		}
		

		content.push('<div  style="height:30px; margin-top:10px; visibility:visible;"><div id="mess_res" style="display:none;"><p>Veuillez changer le statut de la r&eacute;servation avant de valider...</p></div></div>');
		content.push('</div>');
		
		var ctrl_res = content.join("");
		
		m_txt.append(ctrl_res);				
		
		$('#ex_mess').show();
		
		var val_ann = $('#val_ann');
		val_ann.click(function(){
			an_res( trim(tds[0].innerHTML) );
		});
		
		var val_mod = $('#val_mod');
		val_mod.click(function(){
			
			var dhd = trim(tds[3].innerHTML); //date de depart
			// alert(dhd);
				var d_h = dhd.split(' ');
			
			var kil = trim(tds[8].innerHTML);
			// alert(kil);
			var trs_ch = document.getElementById('tab_modres').getElementsByTagName('tr');
			var stat = trs_ch[5].getElementsByTagName('td')[1].getElementsByTagName('div')[0].innerText;
			var check = false;
			var mess_res = $('#mess_res');
			mess_res.attr("style","border: 1px solid gray; border-radius:3px; background-color:#fff");
			
			mess_res.html('');
			// alert(tds[1].innerText+" "+stat);
			if(tds[1].innerText == stat)
			{
				mess_res.append('<p>Veuillez changer le statut de la r&eacute;servation avant de valider...</p>');
				check = true;
			}
			
			if( ($('#newhr').val() == "") || ($('#newmin').val() == "") || ($('#newkilo').val() == "")) 
			{
				mess_res.append('<p>Veuillez remplir tous les champs...</p>');
				check = true;
			}
			
			var cont_dat = $('#newhr').val()+':'+$('#newmin').val()+':00';
			
			if(($('#newhr').val() != "") && ($('#newmin').val() != "")) 
			{
				if( (trim(stat) == "DEPART") && (cont_dat < d_h[1]) )
				{
					mess_res.append('<p>Veuillez entrer une date sup&eacute;rieure ou &eacute;gale &agrave; la date de d&eacute;part pr&eacute;vue  ...</p>');
					check = true;
				}else if( (stat == "RETOUR") && (cont_dat <= d_h[1]) ){
					mess_res.append('<p>Veuillez entrer une date sup&eacute;rieure &agrave; la date de d&eacute;part pr&eacute;vue  ...</p>');
					check = true;
				}
				
			}
			
			if(isNaN($('#newkilo').val()) == true)
			{
				mess_res.append('<p>Veuillez entrer un nombre  ...</p>');
				check = true;
			}else{
				if( (stat == "DEPART") && (parseInt(kil) > parseInt($('#newkilo').val())) )
				{
					mess_res.append('<p>Veuillez entrer entrer un nombre sup&eacute;rieur ou &eacute;gal au kilom&eacute;trage pr&eacute;c&eacute;dent...</p>');
					check = true;
				}else if( (stat == "RETOUR") && (parseInt(kil) >= parseInt($('#newkilo').val())) ){
					mess_res.append('<p>Veuillez entrer entrer un nombre sup&eacute;rieur au kilom&eacute;trage pr&eacute;c&eacute;dent...</p>');
					
					check = true;
				}
			}
			
			if( check == true )
			{
				// alert('eee');
				mess_res.fadeIn();
				window.setTimeout(function(){mess_res.fadeOut();}, 5000);
				return false;
			}
			
			var num = trim(tds[0].innerHTML);
			var nkilo = $('#newkilo').val();
			var ndate = cont_dat;
				
			create_res(num, stat, nkilo, ndate, "change");
			
		});
		
		var ch_veh = $('#ch_veh');
		ch_veh.click(function(){
			
		});
	}
	
	function close_spl()
	{
		$("#div_spl").fadeOut();
		$('.filtre').removeAttr('style');
		$('.excel').removeAttr('style');
	}
	
	//==========================================//
	// Recherche et extraction des données      //
	//==========================================//
		
		function extract_form(a)
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
							{ "name":"sort", value: $('#sort').val() },
							{ "name":"order", value: $('#order').val() },
							{ "name":"limit", value: $('#limit').val() },
							{ "name":"step", value: $('#step').val() },
							{ "name":"datecr", value:$('#r_datecr').val() },
							{ "name":"dem", value:$('#r_demand').val() },
							// { "name":"ben", value:$('#r_benef').val() },
							{ "name":"stat", value:$('#r_stat').val() },
							{ "name":"champs", value:name },
							{ "name":"label", value:label }
						]
			$.post( "reservation/extract_frm", param, function(data){
				if(data)
				{
					// alert(data);
					window.open(data); 
				}
			}, "text");
		}
		
		function extract_res(a)
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
							{ "name": "sort", value: $('#sort1').val() },
							{ "name": "order", value: $('#order1').val() },
							{ "name": "limit", value: $('#limit1').val() },
							{ "name": "step", value: $('#step1').val() },
							{ "name": "stat", value: $('#r_stat1').val() },
							{ "name": "dateres", value: $('#r_dateres').val() },
							{ "name": "dateret", value: $('#r_dateret').val() },
							{ "name": "datedep", value: $('#r_datedep').val() },
							{ "name": "immat", value: $('#r_immat').val() },
							// { "name": "destin", value: $('#r_destin').val() },
							{ "name": "chauf", value: $('#r_chaufeur').val() },
							{ "name": "champs", value: name },
							{ "name": "label", value: label }
						]
			$.post( "reservation/extract_res", param, function(data){
				if(data)
				{
					// alert(data);
					window.open(data); 
				}
			}, "text");
		}
		
		function find_form()
		{
			// initialisation des champs hidden contenant les parametres de recherche...
				//reeinitialisation des champs
				$('#r_datecr').val( "" );
				$('#r_demand').val( "" );
				// $('#r_benef').val( "" );
				$('#r_stat').val( "" );
				
				//passage de parametres aux champs
				
				// var benef = ($('#f_benef').attr('name')).split('-');
				var demnd = ($('#f_demand').attr('name')).split('_');
				// alert( demnd[2] ) ;
				$('#r_datecr').val( $('#f_datecr').val() );
				$('#r_demand').val( demnd[2] );
				// $('#r_benef').val( benef[2] );
				$('#r_stat').val( $('#f_stat').val() );
			//==========================================================================
			
			var param = [
							{ "name":"sort", value: $('#sort').val() },
							{ "name":"order", value: $('#order').val() },
							{ "name":"limit", value: $('#limit').val() },
							{ "name":"step" , value: $('#step').val() },
							{ "name":"datecr", value:$('#f_datecr').val() },
							{ "name":"dem", value: demnd[2] },
							{ "name":"stat", value:$('#f_stat').val() }
						]
			
			var show = "showf";
			
			if( ($('#n_val').length != 0) && ($('#n_val').val() != "") )
			{
				show = "n_form_show";
				param[param.length] = { "name":"new", value: "new" }; 
			}
				
			$.post( "reservation/rgform", param, function(data){
				if(data)
				{
					// alert(data);
					
					var target = document.getElementById(show);
					load_rw( data, target);
											
					var nbr = data.getElementsByTagName('nbre')[0];
					$('#num_rows').val(nbr.attributes[0].nodeValue);
					
					var stp = data.getElementsByTagName('step')[0];
					$('#step').val(stp.attributes[0].nodeValue);
					
					var gDiv = target.parentElement.parentElement;
					
					if ($(target).attr('id') == 'n_form_show')
					{
						var cDiv_ = gDiv.getElementsByTagName('div')[2];
						
					}else{
						var cDiv_ = gDiv.getElementsByTagName('div')[1];
					}
					
					$(cDiv_.getElementsByTagName('div')[0]).html( nbr.attributes[0].nodeValue+" &Eacute;l&eacute;ment(s)" );
					
					var nav_target = cDiv_.getElementsByTagName('div')[1];
					var limit = parseInt($('#limit').val());
					var step = parseInt(stp.attributes[0].nodeValue);
					var num = parseInt(nbr.attributes[0].nodeValue);
								
					$(nav_target).html("");
							
					load_range(nav_target, limit, step, num, 'reservation_rgform');
			
				}
			}, "xml");
			window.setTimeout(function(){ $('#ex_mess').click() }, 2000);
		}
		
		function find_res()
		{
			// initialisation des champs hidden contenant les parametres de recherche...
				// reeinitialisation des champs
				$('#r_stat1').val( "" );
				$('#r_dateres').val( "" );
				$('#r_dateret').val( "" );
				$('#r_datedep').val( "" );
				$('#r_immat').val( "" );
				$('#r_destin').val( "" );
				$('#r_chaufeur').val( "" );
				
				//passage de paramètre
				var destin = ($('#f_destin').attr('name')).split('_');
				var chauffs = ($('#f_chauffeur').attr('name')).split('_');
				var vehs = ($('#f_immat').attr('name')).split('_');
				
				$('#r_stat1').val( $('#f_stat1').val() );
				$('#r_dateres').val( $('#f_dateres').val() );
				$('#r_dateret').val( $('#f_dateret').val() );
				$('#r_datedep').val( $('#f_datedep').val() );
				$('#r_immat').val( $('#f_immat').val() );
				// $('#r_destin').val( destin[2] );
				$('#r_chaufeur').val( chauffs[2] );
			//==========================================================================
			
			var param1 = [
							{ "name":"sort", value: $('#sort1').val() },
							{ "name":"order", value: $('#order1').val() },
							{ "name":"limit", value: $('#limit1').val() },
							{ "name":"step" , value: $('#step1').val() },
							{ "name":"stat", value: $('#f_stat1').val() },
							{ "name":"dateres", value: $('#f_dateres').val() },
							{ "name":"dateret", value: $('#f_dateret').val() },
							{ "name":"datedep", value: $('#f_datedep').val() },
							{ "name":"immat", value: vehs[2] },
							// { "name":"destin", value: destin[2] },
							{ "name":"chauf", value: chauffs[2] }
						]
					// alert($('#f_stat1').val());	
			$.post( "reservation/rgres", param1, function(Adata){
				if(Adata)
				{
					// alert(Adata);
					var target = document.getElementById('show_res');
					load_rw( Adata, target);
						
					var nbr = Adata.getElementsByTagName('nbre')[0];
					$('#num_rows1').val(nbr.attributes[0].nodeValue);
					
					var stp = Adata.getElementsByTagName('step')[0];
					$('#step1').val(stp.attributes[0].nodeValue);
					
					var gDiv = target.parentElement.parentElement;
					var cDiv = gDiv.getElementsByTagName('div')[1].getElementsByTagName('div')[0];
					$(cDiv).html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
					
					var nav_target = gDiv.getElementsByTagName('div')[1].getElementsByTagName('div')[1];
					var limit = parseInt($('#limit1').val());
					var step = parseInt(stp.attributes[0].nodeValue);
					var num = parseInt(nbr.attributes[0].nodeValue);
								
					$(nav_target).html("");
							
					load_range(nav_target, limit, step, num, 'reservation_rgres');
				}
			}, "xml");
			window.setTimeout(function(){ $('#ex_mess').click() }, 2000);
		}
		
		function filtre_form(a)
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
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Date de cr&eacute;ation : </td><td align='left' style='padding-left:20px;'><input id='f_datecr' type='text' class='input_type'/></td></tr>");
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Demandeur : </td><td align='left' style='padding-left:20px;'><input id='f_demand' type='text' class='input_type' onkeyup='f_user(this)'/></td></tr>");
				cont.push("<tr style='display:none;'><td align='left' class='label' style='padding-left:10px;'> B&eacute;n&eacute;ficiaire : </td><td align='left' style='padding-left:20px;'><input id='f_benef' type='text' class='input_type' onkeyup='f_user(this)'/></td></tr>");
				
				if( ($('#new_form').css("visibility") == "hidden") || ($('#new_form').attr("style") == "visibility:hidden;")  )
				{
					cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Statut : </td><td align='left' style='padding-left:20px;'><select id='f_stat' class='input_type'>");
						cont.push("<option></option>");
						cont.push("<option value='annuler'>Annul&eacute;e</option>");
						cont.push("<option value='modifier'>Modif&eacute;e</option>");
						cont.push("<option value='reserver'>R&eacute;servation effectu&eacute;e</option>");
						cont.push("<option value='valider'>Valid&eacute;e</option>");
					cont.push("</select	></td></tr>");
				}
				
				cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Chercher' class='tpl_button_neutral' onclick='find_form();'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
			cont.push("</table>");
			
			var content = cont.join("");
			
			$('#div_spl').html(content);
			$('#f_datecr').datepick();
		}
		
		function filtre_res(a)
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
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Statut : </td><td align='left' style='padding-left:20px;'><select id='f_stat1' class='input_type'>");
					cont.push("<option></option>");
					cont.push("<option value='4'>ANNULEE</option>");
					cont.push("<option value='2'>DEPART</option>");
					cont.push("<option value='3'>RETOUR</option>");
					cont.push("<option value='1'>STAND BY</option>");
				cont.push("</select></td></tr>");
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Date r&eacute;servation : </td><td align='left' style='padding-left:20px;'><input id='f_dateres' type='text' class='input_type'/></td></tr>");
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Date de d&eacute;part : </td><td align='left' style='padding-left:20px;'><input id='f_datedep' type='text' class='input_type'/></td></tr>");
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Date de retour : </td><td align='left' style='padding-left:20px;'><input id='f_dateret' type='text' class='input_type'/></td></tr>");
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> V&eacute;hicule : </td><td align='left' style='padding-left:20px;'><input id='f_immat' type='text' class='input_type' onkeyup='f_car(this)'/></td></tr>");
				cont.push("<tr style='display:none;'><td align='left' class='label' style='padding-left:10px;'> Destinataire : </td><td align='left' style='padding-left:20px;'><input id='f_destin' type='text' class='input_type' onkeyup='f_user(this)'/></td></tr>");
				cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Chauffeur : </td><td align='left' style='padding-left:20px;'><input id='f_chauffeur' type='text' class='input_type' onkeyup='f_chauf(this)'/></td></tr>");
				
				cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Chercher' class='tpl_button_neutral' onclick='find_res();'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
			cont.push("</table>");
			
			var content = cont.join("");
			
			$('#div_spl').html(content);
			$('#f_dateres').datepick();
			$('#f_dateret').datepick();
			$('#f_datedep').datepick();
		}
	
	
		function get_csv_form(a)
		{
			var names = [];
			var input_names = [];
			var ths = document.getElementById('tck_list').getElementsByTagName('thead')[0].getElementsByTagName('th');
			
			for( var i = 0; i < ths.length; i++ )
			{
				names.push( ths[i].getElementsByTagName('a')[0].innerHTML );
				input_names.push( ths[i].getElementsByTagName('input')[0].name );
			}
			
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
				cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Extraire' class='tpl_button_neutral' onclick='extract_form(this)'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
			cont.push("</table>");
			
			var content = cont.join("");
			
			$('#div_spl').html(content);
		}
		
		function get_csv_res(a)
		{
			var names = [];
			var input_names = [];
			var ths = document.getElementById('tck_list1').getElementsByTagName('thead')[0].getElementsByTagName('th');
			
			for( var i = 0; i < ths.length; i++ )
			{
				names.push( ths[i].getElementsByTagName('a')[0].innerHTML );
				input_names.push( ths[i].getElementsByTagName('input')[0].name );
			}
			
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
				cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Extraire' class='tpl_button_neutral' onclick='extract_res(this)'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
			cont.push("</table>");
			
			var content = cont.join("");
			
			$('#div_spl').html(content);
		}
	//===============================//
	//===============================//
	
	
	setInterval(function(){ 
		if( $("#ctrl_res").length == 0 )
		{
			post_els( $('#id').val(), $('#id1').val(), "yes" );
		}
	}, 30000);
	
	function charg_folder( id )
	{ 
		// alert(id);
		var param = 	[ 
							{ "name":"sort" , value: $('#sort').val() },
							{ "name":"order" , value: $('#order').val() },
							{ "name":"limit" , value: $('#limit').val() },
							{ "name":"step" , value: $('#step').val() },
							{ "name":"new" , value: "new"}
						]
		
		if ( id != null )
		{
			param[param.length] = { "name":"id", value: id };
			
		}
		
		$.post( "reservation/rgform", param, function(Adata){
			if(Adata)
			{	
				// alert(Adata);
				var nb = Adata.getElementsByTagName('nbre')[0].attributes[0].nodeValue;
				// alert(nb);
				$('#n_form_show').html('<tr class="" ><td colspan="4" align="center"> Aucun enregistrement </td></tr>');
				if(parseInt(nb) == 0)
				{
					return false;
				}else if(parseInt(nb) == 1){
					$('#div_num').html(nb+" &Eacute;l&eacute;ment")
				}else{
					$('#div_num').html(nb+" &Eacute;l&eacute;ments")
				}
				
				var Ac = $('#n_form_show');
				
				load_rw( Adata, Ac );
				
				if( (id != null) )
				{
					
					var line = Adata.getElementsByTagName('line')[0];
					var nblin = parseInt(line.attributes[0].nodeValue);
					
					$(document.getElementById('n_form_show').getElementsByTagName('tr')[nblin]).trigger('click');
					
					var ida = document.getElementById('n_form_show').getElementsByTagName('tr')[nblin].getElementsByTagName('td')[0].innerHTML;
					$('#id2').val(trim(ida));
				}
				
				var nbr = Adata.getElementsByTagName('nbre')[0];
				$('#num_rows').val(nbr.attributes[0].nodeValue);
				
				var stp = Adata.getElementsByTagName('step')[0];
				$('#step').val(stp.attributes[0].nodeValue);
				
				var gDiv = document.getElementById('n_form_show').parentElement.parentElement;
				
				var cDiv_ = gDiv.getElementsByTagName('div')[2];
				
				$(cDiv_.getElementsByTagName('div')[0]).html( nbr.attributes[0].nodeValue+" &Eacute;l&eacute;ment(s)" );
				
				var nav_target = cDiv_.getElementsByTagName('div')[1];
				var limit = parseInt($('#limit').val());
				var step = parseInt(stp.attributes[0].nodeValue);
				var num = parseInt(nbr.attributes[0].nodeValue);
							
				$(nav_target).html("");
						
				load_range(nav_target, limit, step, num, 'reservation_rgform');
			}
		}, "xml");
	}
	
	// Ouverture du tableau de new_formulaire
	$('#switch').click(function(){
		
		$('#new_form').css('visibility','visible');
		$('#n_val').val("n_form_show"); 
		$('#n_form_show').html(" <tr><td colspan='4' align='center'> <img src='"+$('#imgurl').val()+"12.gif' > </td></tr> ");
				
		charg_folder(null);
	});
	
	//fermeture du tableau de new_formulaire
	$('#ex_des').click( function(){ 
		$('#new_form').css('visibility','hidden');
		$('#n_val').val("");
		$('#step').val("1"); 
		if( $("#ctrl_res").length == 0 )
		{
			post_els( $('#id').val(), $('#id1').val(), "yes" );
		}
	});
	
	// $("body").click(function(){
		// $( "#div_alert .alert a" ).trigger("click");
	// });